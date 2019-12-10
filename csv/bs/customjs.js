(function () {
    var app = angular.module('myApp', []);
    app.controller('MyController', ['$scope', myController]);

    var excelJsonObj = [];
    
    
    function myController($scope){
        $scope.uploadCSV = function(){
            var idGrupo = document.getElementById("idGrupo").value;
            console.log("Value to add: " + idGrupo);
            excelJsonObj.push(idGrupo);

            var myFile = document.getElementById('file');
            var input = myFile;
            var reader = new FileReader();
            reader.onload = function() {
                var fileData = reader.result;
                var workbook = XLSX.read(fileData, {type: 'binary'});
                workbook.SheetNames.forEach(function(sheetName){
                    var rowObject = XLSX.utils.sheet_to_json(workbook.Sheets[sheetName],{header:1});
                    for(var i=0; i<rowObject.length; i++){
                        excelJsonObj.push(rowObject[i]);
                    }
                });

                for(var i = 0; i < excelJsonObj.length; i++){
                    var data = excelJsonObj[i];
                    //0 - no. de lista
                    //1 - apellidos
                    //2 - nombres
                    $('#myTable tbody:last-child').append("<tr><td>"+data[0]+"</td><td>"+data[1]+"</td><td>"+data[2]+"</td></tr>");
                }
                
                console.log(excelJsonObj);

                $.ajax({
                    method: "POST",
                    url: "/bs/Conn.php",
                    dataType: "json",
                    data: JSON.stringify(excelJsonObj),
                    success : function() { 
                        console.log("Sent to server!");
                    }
                });
            };

            reader.readAsBinaryString(input.files[0]);
        };
    }
   
}

)();