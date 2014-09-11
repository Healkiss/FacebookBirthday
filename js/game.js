var playerList = ['blue', 'orange', 'green', 'white'];

var turn = 0;
var playgrounds;

var display = function() {
    var playground = playgrounds[turn]; 
    console.log(turn); 
    console.log(playground); 

    table = $('<table>');
    for (var i=0; i<playground.length; i++) {

        row = $('<tr>');

        for (var j=0; j<playground[i].length; j++) {

            data = playground[i][j];

            col = $('<td>');
            col.addClass(data['type']);
            col.addClass(playerList[data['player']]);

            if (data['next'] != undefined) {
                col.addClass('next');
                col.addClass(playerList[playground[i][j]['next']]);
            }

            row.append(col);
        }
        table.append(row);
    }

    div = $('<div>');
    div.append(table);
    $('#game').html(div.html());
}

window.onload = function() {
    var fileInput = document.getElementById('fileInput');

    fileInput.addEventListener('change', function(e) {
        var file = fileInput.files[0];
        var textType = /text.*/;

        if (file.type.match(textType)) {
            var reader = new FileReader();

            reader.onload = function(e) {
                playgrounds = JSON.parse(reader.result);
                display();
            }

            reader.readAsText(file);	
        } else {
            fileDisplayArea.innerText = "File not supported!";
        }
    });
}

$(window).keypress(function(e) {
    var key = e.which;
    console.log(key)

    if (key == 107 && turn > 0) {
        turn -= 1;
        display();
    } else if (key == 106 && turn < playgrounds.length-1) {
        turn += 1;
        display();
    }

});
