function SnakeGame(parentElement){
    let engine = new engine(parentElement);

    /**
     * These methods below (init, pause, resume) are publically accessible.
  "cn   */
    this.init = function(){
        engine.initGame();
    };

    this.pause = function(){
        engine.pauseGame();
    };

    this.resume = function(){
        engine.resume();
    };

    this.getHighScore = function(){
        return engine.getHighScore();
    };
}



class constants {
    static DIRECTION_UP = 1;
    static DIRECTION_RIGHT = 2;
    static DIRECTION_DOWN = -1;
    static DIRECTION_LEFT = -2;
    static DEFAULT_DIRECTION = 2;
    static STATE_READY = 1;
    static STATE_PAUSED = 2;
    static STATE_PLAYING = 3;
    static STATE_GAME_OVER = 4;
    static INITIAL_SNAKE_GROWTH_LEFT = 6;
    static SCOREBOARD_HEIGHT = 20;
    static CANDY_REGULAR = 1;
    static CANDY_MASSIVE = 2;
}

class config  {

        static autoInit = true;
        static gridWidth = 30;
        static gridHeight = 20;
        static frameInterval = 150;
        static pointSize = 16;
        static backgroundColor = "white";
        static snakeColor = "#4b4312";
        static snakeEyeColor = "white";
        static candyColor = "#b11c1c";
        static scoreBoardColor = "#c0c96b";
        static scoreTextColor = "#4b4312";
        static collisionTolerance = 1



};

class grid{
    constructor(width,height){
        this.width=width;
        this.height=height;
    }

}

class snake{
    constructor(){
        this.direction = constants.DEFAULT_DIRECTION;
        this.points=[];
        this.growthLeft=0;
        this.alive=true;
    }

    get getDirection(){return this.direction}


    collidesWith(point,simulateMovement){
        let range;
        if (simulateMovement && this.growthLeft === 0)
            range = this.points.length - 1;
        else
            range = this.points.length;
        for (let i = 0; i < range; i++) {
            if (point.collidesWith(this.points[i]))
                return true;
        }
        return false;
    }
}

class point{
    constructor(left,lop){
        this.left=left;
        this.top=top;
    }

    collidesWith(otherPoint){
        if (otherPoint.left == this.left && otherPoint.top == this.top)
            return true;
        else
            return false;
    };
}


class candy{
    constructor(point){
        this.point=point;
        this.score;
        this.calories;
        this.radius;
        this.color;
        this.decrement;
        this.minRadius;
    }

    get getColor(){return this.color}
}

class regularCandy extends candy{
    constructor(point){
        super(point);
        this.score = 5;
        this.calories = 3;
        this.radius = 0.3;
        this.color = config.candyColor;
    }
}

class massiveCandy extends candy{
    constructor(point){
        super(point);
        this.score = 15;
        this.calories = 5;
        this.radius = 0.45;
        this.color = config.candyColor;
    }
}

//Contient tout ce qui gère la vue
class view {
    playField;
    ctx;
    snakeThickness;
    config;

    constructor(parentElement, backgroundColor) {
        this.parentElement = parentElement;
        this.backgroundColor = backgroundColor;
    }

    initPlayField() {
        this.snakeThickness = length(0.9);

        this.playField = document.createElement("canvas");
        this.playField.setAttribute("id", "snake-js");
        this.playField.setAttribute("width", (config.gridWidth * config.pointSize).toString());
        this.playField.setAttribute("height", (config.gridHeight * config.pointSize + constants.SCOREBOARD_HEIGHT).toString());
        this.parentElement.appendChild(this.playField);
        this.ctx = this.playField.getContext("2d");

        this.ctx.translate(0, constants.SCOREBOARD_HEIGHT);
    }

    getPointPivotPosition(point) {
        let position = {
            left : point.left * length(1) + length(.5),
            top : point.top * length(1) + length(.5)
        };
        return position;
    };

    connectWallPoints(p1, p2) {

        // The position of these points in screen pixels
        let p2Position = this.getPointPivotPosition(p2);

        // This holds -1 or 1 if points are separated horizontally, else 0
        let leftOffset = utilities.sign(p2.left - p1.left);
        // This holds -1 or 1 if points are separated vertically, else 0
        let topOffset = utilities.sign(p2.top - p1.top);

        // First let's look at p1
        // Create a fake end point outside the grid, next to p1
        let fakeEndPoint = new point(p1.left - leftOffset, p1.top - topOffset);
        // And get the screen position
        let fakeEndPointPosition = this.getPointPivotPosition(fakeEndPoint);
        // End the current line (which was initially drawn outside this method) in this fake point
        this.ctx.lineTo(fakeEndPointPosition.left, fakeEndPointPosition.top);

        // Let's look at p2. Create a fakepoint again and get it's position...
        let fakeStartPoint = new point(p2.left + leftOffset, p2.top + topOffset);
        let fakeStartPointPosition = this.getPointPivotPosition(fakeStartPoint);
        // ...But this time, first move the pencil (without making a line) to the fake point
        this.ctx.moveTo(fakeStartPointPosition.left, fakeStartPointPosition.top);
        // Then make a line to p2. Note that these lines are not drawn, since this method
        // only connects the lines, the drawing is handled outside this method
        this.ctx.lineTo(p2Position.left, p2Position.top);
    };

    drawSnake(snake, color){
        if(!typeof snake === "snake"){
            throw "snake expected";
        }
        if (snake.points.length === 1) {
            let position = this.getPointPivotPosition(snake.points[0]);

            this.ctx.fillStyle = color;
            this.ctx.beginPath();
            this.ctx.arc(position.left, position.top, this.snakeThickness/2, 0, 2*Math.PI, false);
            this.ctx.fill();
        }
        else {

            this.ctx.strokeStyle = color;
            this.ctx.lineWidth = this.snakeThickness;
            this.ctx.lineJoin = "round";
            this.ctx.lineCap = "round";

            // Bein path drawing.
            this.ctx.beginPath();

            // Loop over the points, beginning with the head
            for (let i = 0; i < snake.points.length; i++) {

                // Short name for the point we're looking at now
                let currentPoint = snake.points[i];

                // If we're looking at the head
                if (i === 0) {
                    // The position of this point in screen pixels
                    let currentPointPosition = this.getPointPivotPosition(currentPoint);
                    // Don't draw anything, just move the "pencil" to the position of the head
                    this.ctx.moveTo(currentPointPosition.left, currentPointPosition.top);
                }
                // If we're looking at any other point
                else {
                    // Short name to the previous point (which we looked at in the last iteration)
                    let prevPoint = snake.points[i-1];

                    // If these points are next to each other (Snake did NOT go through the wall here)
                    if(Math.abs(prevPoint.left - currentPoint.left) <= 1 && Math.abs(prevPoint.top - currentPoint.top) <= 1){
                        // The position of this point in screen pixels
                        let currentPointPosition = this.getPointPivotPosition(currentPoint);
                        // Draw pencil from the position of the "pencil" to this point
                        this.ctx.lineTo(currentPointPosition.left, currentPointPosition.top);
                    }
                    // If these points are far away from each other (Snake went through wall here)
                    else {
                        // Connect these points together. This method will simulate wall entrance/exit if necessary
                        this.connectWallPoints(prevPoint, currentPoint);
                    }
                }
            }
            // Now draw the snake to screen
            this.ctx.stroke();
        }

        // Draw the eye of the snake
        this.drawEye(snake, snake.direction);
    };

    drawEye(snake) {
        if(!typeof snake === "snake"){
            throw "snake expected";
        }
        let head = snake.points[0];
        let headPosition = this.getPointPivotPosition(head);

        // Imagine the snake going from right to left.
        // These values determine how much to the left and top the eye's pivot point is adjusted.
        let offsetLeft = length(0.125);
        let offsetTop = length(0.15);

        // Place the eye's pivot point differentely depending on which direction the snake moves
        switch (snake.direction){
            case constants.DIRECTION_LEFT:
                headPosition.left -= offsetLeft;
                headPosition.top -= offsetTop;
                break;
            case constants.DIRECTION_RIGHT:
                headPosition.left += offsetLeft;
                headPosition.top -= offsetTop;
                break;
            case constants.DIRECTION_UP:
                headPosition.left -= offsetTop;
                headPosition.top -= offsetLeft;
                break;
            case constants.DIRECTION_DOWN:
                headPosition.left += offsetTop;
                headPosition.top += offsetLeft;
                break;
        }

        // If the snake is still alive draw a circle
        if (snake.alive) {
            this.ctx.beginPath();
            this.ctx.fillStyle = config.snakeEyeColor;
            // Draw the circle
            this.ctx.arc(headPosition.left, headPosition.top, length(0.125), 0, Math.PI*2, false);
            // And fill it
            this.ctx.fill();
        }
        // If the snake is dead, draw a cross
        else {
            this.ctx.beginPath();
            this.ctx.strokeStyle = config.snakeEyeColor;
            this.ctx.lineWidth = 2;
            this.ctx.moveTo(headPosition.left - length(0.1), headPosition.top - length(0.1));
            this.ctx.lineTo(headPosition.left + length(0.1), headPosition.top + length(0.1));
            this.ctx.moveTo(headPosition.left + length(0.1), headPosition.top - length(0.1));
            this.ctx.lineTo(headPosition.left - length(0.1), headPosition.top + length(0.1));
            this.ctx.stroke();
        }
    };

    drawCandy(candy){
        if(!typeof candy === "candy"){
            throw "candy expected";
        }
        this.ctx.fillStyle = candy.color;

        let position = this.getPointPivotPosition(candy.point);

        this.ctx.beginPath();

        this.ctx.arc(position.left, position.top, length(candy.radius), 0, Math.PI*2, false);
        this.ctx.fill();
    };

    clear(color) {
        this.ctx.fillStyle = color || this.backgroundColor;
        this.ctx.fillRect(0, 0,
            config.gridWidth * config.pointSize,
            config.gridHeight * config.pointSize);
    };

    drawScore(score, highScore){
        // Translate to 0, 0 to draw from origo
        this.ctx.translate(0, -1 * constants.SCOREBOARD_HEIGHT);

        let bottomMargin = 5;
        let horizontalMargin = 4;

        // Draw the score board
        this.ctx.fillStyle = config.scoreBoardColor;
        this.ctx.fillRect(0, 0, config.gridWidth * config.pointSize, constants.SCOREBOARD_HEIGHT);

        // Prepare drawing text
        this.ctx.fillStyle = config.scoreTextColor;
        this.ctx.font = "bold 16px 'Courier new', monospace";

        // Draw score to the upper right corner
        this.ctx.textAlign = "right";
        this.ctx.fillText(score, config.gridWidth * config.pointSize - horizontalMargin, constants.SCOREBOARD_HEIGHT - bottomMargin);

        // Draw high score to the upper left corner
        this.ctx.textAlign = "left";
        this.ctx.fillText(highScore, horizontalMargin, constants.SCOREBOARD_HEIGHT - bottomMargin);

        // Translate back
        this.ctx.translate(0, constants.SCOREBOARD_HEIGHT);
    };

    length(value){
        return value*config.pointSize;
    }

}

class utilities{
    static sign(number){
        if(number > 0)
            return 1;
        else if (number < 0)
            return -1;
        else if (number === 0)
            return 0;
        else
            return undefined;
    }

    static oppositeDirections(direction1,direction2){
        if (Math.abs(direction1) == Math.abs(direction2) &&
            this.sign(direction1 * direction2) == -1) {
            return true;
        }
        else {
            return false;
        }
    }

    static mergeObjects(slave, master){
        var merged = {};
        for (key in slave) {
            if (typeof master[key] === "undefined")
                merged[key] = slave[key];
            else
                merged[key] = master[key];
        }
        return merged;
    };

    static randomInteger(min, max){
        var randomNumber = min + Math.floor(Math.random() * (max + 1));
        return randomNumber;
    };
}

class inputInterface{

    constructor(pauseFn,resumeFn, autoPlayFn){
        this.pause=pauseFn;
        this.resume=resumeFn;
        this.autoPlay=autoPlayFn;
        this.arrowKeys=[37,38,39,40];
        this.listening=false;
        this.lastDirection=null;

    }

    lastDirection(){return lastDirection}

    startListening(){
        if (!this.listening) {
            window.addEventListener("keyDown", this.handleKeyDown, true);
            window.addEventListener("keyPress", this.disableKeyPress, true);
            window.addEventListener("blur", this.pause, true);
            window.addEventListener("focus", this.resume, true);
            this.listening = true;
        }
    };

    stopListening(){
        if (this.listening) {
            window.removeEventListener("keydown", this.handleKeyDown, true);
            window.removeEventListener("keypress", this.disableKeyPress, true);
            window.removeEventListener("blur", this.pause, true);
            window.removeEventListener("focus", this.resume, true);
            this.listening = false;
        }
    };

    handleKeyDown(event){
        // If the key pressed is an arrow key
        if (this.arrowKeys.indexOf(event.keyCode) >= 0) {
            this.handleArrowKeyPress(event);
        }
    };

    disableKeyPress(event){
        // If the key pressed is an arrow key
        if (this.arrowKeys.indexOf(event.keyCode) >= 0) {
            event.preventDefault();
        }
    };

    handleArrowKeyPress(event){
        with (constants) {
            switch (event.keyCode) {
                case 37:
                    lastDirection = DIRECTION_LEFT;
                    break;
                case 38:
                    lastDirection = DIRECTION_UP;
                    break;
                case 39:
                    lastDirection = DIRECTION_RIGHT;
                    break;
                case 40:
                    lastDirection = DIRECTION_DOWN;
                    break;
            }
        }
        // Arrow keys usually makes the browser window scroll. Prevent this evil behavior
        event.preventDefault();
        // Call the auto play function
        this.autoPlay();
    };

}

class engine{
    constructor(parentElement){
        this.parentElement=parentElement;
        this.view= new view(this.parentElement,config.backgroundColor);
        this.inputInterface=new inputInterface(this.pauseGame,this.resumeGame,this.startMoving);
        this.snake=new snake();
        this.grid= new grid(config.gridWidth,config.gridHeight);
        this.score=0;
        this.highScore=this.score;

        this.candy = this.randomCandy();
        this.currentState=null;
        this.frameIntervalId=null;
    }

    initGame(){
        this.snake.points.push(this.randomPoint(this.grid));
        this.snake.growthLeft = constants.INITIAL_SNAKE_GROWTH_LEFT;
        this.view.initPlayField();
        this.drawCurrentScene();
        this.inputInterface.startListening();
        this.currentState = constants.STATE_READY;

    }

    pauseGame(){
        if (this.currentState === constants.STATE_PLAYING) {
            clearInterval(this.frameIntervalId);
            this.currentState = constants.STATE_PAUSED;
        }
    }

    resumeGame(){
        if (this.currentState === constants.STATE_PAUSED) {
            this.frameIntervalId = setInterval(this.nextFrame, config.frameInterval);
            this.currentState = constants.STATE_PLAYING;
        }
    }

    getHighScore(){
        return this.highScore;
    };

    gameOver(){
        this.currentState = constants.STATE_GAME_OVER;
        clearInterval(this.frameIntervalId);

        // Remove one point from the snakes tail and recurse with a timeout
        let removeTail = function(){
            if (this.snake.points.length > 1) {
                this.snake.points.pop();
                this.drawCurrentScene();
                setTimeout(removeTail, config.frameInterval/4);
            }
            else
                setTimeout(resurrect, config.frameInterval * 10);
        };

        let resurrect = function (){
            this.score = 0;
            snake.growthLeft = constants.INITIAL_SNAKE_GROWTH_LEFT;
            snake.alive = true;
            this.drawCurrentScene();
            this.currentState = constants.STATE_READY;
        };

        setTimeout(removeTail, config.frameInterval * 10);
    };

    startMoving() {
        if (this.currentState === constants.STATE_READY) {
            this.frameIntervalId = setInterval(this.nextFrame, config.frameInterval);
            this.currentState = constants.STATE_PLAYING;
        }
    }

    nextFrame(){
        if (!this.moveSnake(inputInterface.lastDirection())) {
            if (this.collisionFramesLeft > 0) {
                // Survives for a little longer
                this.collisionFramesLeft--;
                return;
            }
            else {
                // Now it's dead
                this.snake.alive = false;
                // Draw the dead snake
                this.drawCurrentScene();
                // And play game over scene
                this.gameOver();
                return;
            }
        }
        // It can move.
        else
            this.collisionFramesLeft = config.collisionTolerance;

        // If the snake hits a candy
        if(this.candy.point.collidesWith(snake.points[0])) {
            this.eatCandy();
            this.candy = this.randomCandy();
        }

        this.drawCurrentScene();
    }

    drawCurrentScene(){
        this.view.clear();
        this.view.drawnSnake(this.snake,config.snakeColor);
        this.view.drawnCandy(candy);
        this.view.drawScore(this.score,this.highScore);
    }

    moveSnake(desiredDirection){
        let head = this.snake.points[0];

        // The direction the snake will move in this frame
        let newDirection = this.actualDirection(desiredDirection || constants.DEFAULT_DIRECTION);

        let newHead = this.movePoint(head, newDirection);

        if (!this.insideGrid(newHead, grid))
            this.shiftPointIntoGrid(newHead, grid);

        if (this.snake.collidesWith(newHead, true)) {
            // Can't move. Collides with itself
            return false;
        }

        this.snake.direction = newDirection;
        this.snake.points.unshift(newHead);

        if (this.snake.growthLeft >= 1)
            this.snake.growthLeft--;
        else
            this.snake.points.pop();

        return true;
    };

    eatCandy(){
        this.score += this.candy.score;
        this.highScore = Math.max(this.score, this.highScore);
        this.snake.growthLeft += this.candy.calories;
    };

    randomCandy(){
        let newCandyPoint;
        let newType;
        // Find a new position for the candy, and make sure it's not inside the snake
        do {
             newCandyPoint = this.randomPoint(grid);
        } while(this.snake.collidesWith(newCandyPoint));
        // Gives a float number between 0 and 1
        var probabilitySeed = Math.random();
        if (probabilitySeed < 0.75)
             newType = constants.CANDY_REGULAR;
        else if (probabilitySeed < 0.95)
             newType = constants.CANDY_MASSIVE;
        return new candy(newCandyPoint, newType);
    };

    // Get the direction which the snake will go this frame
    // The desired direction is usually provided by keyboard input
    actualDirection(desiredDirection){
        if (this.snake.points.length === 1)
            return desiredDirection;
        else if (utilities.oppositeDirections(this.snake.direction, desiredDirection)) {
            // Continue moving in the snake's current direction
            // ignoring the player
            return this.snake.direction;
        }
        else {
            // Obey the player and move in that direction
            return desiredDirection;
        }
    };

    // Take a point (oldPoint), "move" it in any direction (direction) and
    // return a new point (newPoint) which corresponds to the change
    // Does not care about borders, candy or walls. Just shifting position.
    var movePoint = function(oldPoint, direction){
        var newPoint;
        with (constants) {
            switch (direction) {
                case DIRECTION_LEFT:
                    newPoint = new point(oldPoint.left-1, oldPoint.top);
                    break;
                case DIRECTION_UP:
                    newPoint = new point(oldPoint.left, oldPoint.top-1);
                    break;
                case DIRECTION_RIGHT:
                    newPoint = new point(oldPoint.left+1, oldPoint.top);
                    break;
                case DIRECTION_DOWN:
                    newPoint = new point(oldPoint.left, oldPoint.top+1);
                    break;
            }
        }
        return newPoint;
    };

    // Shifts the points position so that it it is kept within the grid
    // making it possible to "go thru" walls
    shiftPointIntoGrid(point, grid){
        point.left = this.shiftIntoRange(point.left, grid.width);
        point.top = this.shiftIntoRange(point.top, grid.height);
        return point;
    };

    // Helper function for shiftPointIntoGrid
    // E.g. if number=23, range=10, returns 3
    // E.g.2 if nubmer = -1, range=10, returns 9
    var shiftIntoRange = function(number, range) {
        var shiftedNumber, steps;
        if (utilities.sign(number) == 1){
            steps = Math.floor(number/range);
            shiftedNumber = number - (range * steps);
        }
        else if (utilities.sign(number) == -1){
            steps = Math.floor(Math.abs(number)/range) + 1;
            shiftedNumber = number + (range * steps);
        }
        else {
            shiftedNumber = number;
        }
        return shiftedNumber;
    };

    // Check if a specific point is inside the grid
    // Returns true if inside, false otherwise
    insideGrid(point, grid){
        if (point.left < 0 || point.top < 0 ||
            point.left >= grid.width || point.top >= grid.height){
            return false;
        }
        else {
            return true;
        }
    };

    // Returns a point object with randomized coordinates within the grid
    randomPoint(grid){
        var left = utilities.randomInteger(0, grid.width - 1);
        var top = utilities.randomInteger(0, grid.height - 1);
        var point = new Point(left, top);
        return point;
    };


}