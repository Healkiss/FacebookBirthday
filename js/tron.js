var Tron = (function($, Tron) {

    "use strict";

    Tron = Tron || {};

    Tron = function() {
        this.backgroundDiv = $('#background');
        this.backgroundSize = 20;
        this.bikesNumber = 2;
        this.bikesNumberToPlace = 2;
        this.step = 2;
        this.gameType = 0;
    };

    var proto = Tron.prototype;

    proto.init = function(){
        this.listenners();
        this.backdroundDraw = this.drawBackground();
        this.displayBackground();
    }

    proto.listenners = function(){
        var global = this;
        $("body").on('click', "td", function(){
            if(global.bikesNumberToPlace > 0 && $(this).hasClass("empty")){
                var row = $(this).data('row');
                var column = $(this).data('column');
                var inverseRow = (global.backgroundSize-1) - (row);
                var inverseColumn = (global.backgroundSize-1) - (row);
                $(this).removeClass("empty");
                $(this).addClass("head orange");
                $("td[data-row='"+inverseRow+"'][data-column='"+column+"']").removeClass("empty");
                $("td[data-row='"+inverseRow+"'][data-column='"+column+"']").addClass("head blue");
                global.bikesNumberToPlace--;
                $("#bikesNumberToPlace").html(global.bikesNumberToPlace);
                if(global.bikesNumberToPlace == 0){
                    $("#bikesPlacementStep").removeClass("alert-danger glyphicon-remove");
                    $("#bikesPlacementStep").addClass("alert-success glyphicon-ok");
                    global.checkStep();
                }
            }else if( !$(this).hasClass("empty") && $(this).hasClass("orange") ){
                var row = $(this).data('row');
                var column = $(this).data('column');
                var inverseRow = (global.backgroundSize-1) - (row);
                var inverseColumn = (global.backgroundSize-1) - (row);
                $("td[data-row='"+inverseRow+"'][data-column='"+column+"']").addClass("empty");
                $("td[data-row='"+inverseRow+"'][data-column='"+column+"']").removeClass("head blue");
                $(this).removeClass("orange");
                $(this).removeClass("head")
                $(this).addClass("empty");
                global.bikesNumberToPlace++;
                $("#bikesNumberToPlace").html(global.bikesNumberToPlace);
                $("#bikesPlacementStep").removeClass("alert-success glyphicon-ok");
                $("#bikesPlacementStep").addClass("alert-danger glyphicon-remove");
                global.checkStep();
            }
        });
        $('input[name=backgroundSize]').keyup(function() {
            var val = $(this).val();
            global.changeSize(val);
            global.changeBikesNumber(global.bikesNumberToPlace);
        });
        $('input[name=bikesNumber]').keyup(function() {
            var val = $(this).val();
            global.changeBikesNumber(val);
        });
        $('.players').on('click', function() {
            var val = $(this).data('players');
            $(".gameStyle").removeClass("gameStyleClicked");
            $(this).addClass("gameStyleClicked");
            switch(val){
                case "hvh":
                    $('#player1Icon').prop("src", 'resources/human.jpg');
                    $('#player2Icon').prop("src", 'resources/human.jpg');
                    break;
                case "hvia":
                    $('#player1Icon').prop("src", 'resources/human.jpg');
                    $('#player2Icon').prop("src", 'resources/ia.jpg');
                    break;
                case "iavia":
                    $('#player1Icon').prop("src", 'resources/ia.jpg');
                    $('#player2Icon').prop("src", 'resources/ia.jpg');
                    break;
                default:
                    alert('cas non géré');
            }
            $("#gameTypeStep").removeClass("alert-danger glyphicon-remove");
            $("#gameTypeStep").addClass("alert-success glyphicon-ok");
            global.gameType = 1;
            global.checkStep();
        });
    }
    
    proto.checkStep = function(){
        if (this.bikesNumberToPlace == 0 && this.gameType){
            $("#btnBegin").removeClass("disabled"); 
        }else{
            $("#btnBegin").addClass("disabled"); 
        }
    }

    proto.drawBackground = function(){
        var size = this.backgroundSize;
        var tableStart = "<table>";
        var tableEnd = "</table>";
        var tableRowStart = "<tr>";
        var tableRowEnd = "</tr>";
        var tableDataStart = "<td class='empty' data-row='' data-column=''>";
        var tableDataEnd = "</td>";
        var tableData = tableDataStart + tableDataEnd;
        var table = tableStart;
        for(var i = 0; i < size; i++){
            table += tableRowStart;
            for(var j = 0; j < size; j++){
                var tableDataStartBis = tableDataStart.replace("data-row=''", "data-row='"+i+"'");
                tableDataStartBis = tableDataStartBis.replace("data-column=''", "data-column='"+j+"'");
                tableData = tableDataStartBis + tableDataEnd;
                table += tableData;
            }
            table += tableRowEnd;
        }
        table += tableEnd;
        return table;
    }

    proto.displayBackground = function(){
        this.backgroundDiv.html(this.backdroundDraw);
    }

    proto.changeSize = function(val){
        if(val == ""){
            this.backgroundSize = 20
        }else{
            this.backgroundSize = val
        }
        $("#backgroundStep").removeClass("alert-warning");
        $("#backgroundStep").addClass("alert-success glyphicon-ok");
        $("#backgroundSize").html(this.backgroundSize + " x " + this.backgroundSize);
        this.bikesNumberToPlace = this.bikesNumber;
        this.checkStep();
        $("#bikesNumberToPlace").html(this.bikesNumberToPlace);
        this.backdroundDraw = this.drawBackground();
        this.displayBackground();
    }

    proto.changeBikesNumber = function(val){
        if(val == ""){
            this.bikesNumber = 2;
        }else{
            this.bikesNumber = val;
        }
        this.bikesNumberToPlace = this.bikesNumber;
        this.checkStep();
        $("#bikesNumberStep").removeClass("alert-warning");
        $("#bikesNumberStep").addClass("alert-success glyphicon-ok");
        $("#bikesPlacementStep").removeClass("alert-success glyphicon-ok");
        $("#bikesPlacementStep").addClass("alert-danger glyphicon-remove");
        $("#bikesNumber").html(this.bikesNumber);
        $("#bikesNumberToPlace").html(this.bikesNumberToPlace);
        this.displayBackground();
    }

    return Tron;

}(jQuery, Tron));