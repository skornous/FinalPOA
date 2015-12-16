import GameOfLife from 'game-of-life-es6';

// Very simple vanilla JavaScript implementation
var x = 10,
    y = 15,
    element = document.getElementById('game-of-life'),
    world = new GameOfLife.World(x, y);

element.style.height = y * 10 + 'px';
element.style.width = x * 10 + 'px';

function renderWorld(element, world) {
    var i,
        j,
        node,
        className,
        child,
        fragment = document.createDocumentFragment();

    while (child = element.firstChild) {
        element.removeChild(child);
    }
    for (i = 1; i <= y; i++) {
        for (j = 1; j <= x; j++) {
            node = document.createElement('span');
            className = 'cell cell-' + j + '-' + i;
            if (world.getCoordinateAt(j, i).hasLiveCell()) {
                className += ' active';
            }
            node.className = className;
            fragment.appendChild(node);
        }
    }
    element.appendChild(fragment);
}

renderWorld(element, world);
setInterval(function () {
    world.tick();
    renderWorld(element, world);
}, 500);

//# sourceMappingURL=testGame-compiled.js.map

//# sourceMappingURL=testGame-compiled-compiled.js.map