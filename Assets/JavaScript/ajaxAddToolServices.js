/*
 * The document ready function which runs automatically after the HTML page is loaded.
 */
$(function()
    {
    // Set up the click handler of the add tubular button
    $("#addTubular").click(function () {
            addTubularToDatabase();
        }
    );

    // Set up the click handler of the add tubular button
    $("#addTool").click(function () {
            addToolToDatabase();
        }
    );

    // Set up the click handler of the add tubular button
    $("#linkToolTubular").click(function () {
            addCutToDatabase();
        }
    );

    //populate radio checkbox lists after the page is loaded
    populateTubularCheckBoxList();
    populateToolRadioList();
    }
);

/*
 *Function to handle add tubular button
 */
function addTubularToDatabase()
{
    var tubularOD=$("#tubularOD").val();
    var tubularID=$("#tubularID").val();
    var weight=$("#weight").val();

    var url="./Assets/AjaxServices/AddTubular.php";
    var data={  "tubularOD":tubularOD,
                "tubularID":tubularID,
                "weight":weight
                };

    $.post(url, data, function(result){
        alert(result.message);
        populateTubularCheckBoxList();
    });
}

/*
 *Function to handle add tool button
 */
function addToolToDatabase()
{
    var toolOD=$("#toolOD").val();
    var minPressure=$("#minPressure").val();
    var maxPressure=$("#maxPressure").val();
    var minTemp=$("#minTemp").val();
    var maxTemp=$("#maxTemp").val();

    var url="./Assets/AjaxServices/AddTool.php";
    var data={  "toolOD":toolOD,
                "minPressure":minPressure,
                "maxPressure":maxPressure,
                "minTemp":minTemp,
                "maxTemp":maxTemp
    };

    $.post(url, data, function(result){
        alert(result.message);
        populateToolRadioList();
    });
}

/*
 *Function to handle add tool/tubular link button
 */
function addCutToDatabase()
{
    // Get tool ID
    var toolID = $("input[name='tool']:checked").val();

    // Get tubular IDs
    var tubulars = [];
    $.each($("input[name='tubulars']:checked"), function(){
        tubulars.push($(this).val());
    });

    var url="./Assets/AjaxServices/AddCuts.php";
    var data={  "toolID":toolID,
                "tubulars":tubulars
    };

    $.post(url, data, function(result){
        alert(result.message);
    });
}

/*
Function to populate tubular checkbox list
 */
function populateTubularCheckBoxList()
{
    var url="./Assets/AjaxServices/ReadTubulars.php";
    var data={};

    $.getJSON(  url, data,
        function(result)
        {
            $("#TUBULAR").empty();      //remove all children first
            for (var index in result)
            {
                var tubular=result[index];
                var htmlCode="<p>";
                htmlCode+="<input class='w3-check' type='checkbox' name='tubulars' value='"+ tubular["tubularID"]+"'>";
                htmlCode+="<label>OD: "+tubular["OD"]+" ID: "+tubular["ID"]+" Weight: "+tubular["weight"]+"</label>";
                htmlCode+="</p>";
                $("#TUBULAR").append(htmlCode);
            }
        }
    );
}

/*
Function to populate tubular checkbox list
 */
function populateToolRadioList()
{
    var url="./Assets/AjaxServices/ReadTools.php";
    var data={};

    $.getJSON(  url, data,
        function(result)
        {
            $("#TOOL").empty();      //remove all children first
            for (var index in result)
            {
                var tool=result[index];
                var htmlCode="<p>";
                htmlCode+="<input class='w3-radio' type='radio' name='tool' value='"+ tool["toolID"]+"'>";
                htmlCode+="<label>OD: "+tool["OD"]+" in, Min Temp: "+tool["minTemp"]+" degC, Max Temp: "+tool["maxTemp"]+" degC, ";
                htmlCode += " Min Pressure: "+tool["minPressure"]+" psi, Max Pressure: "+tool["maxPressure"]+"psi</label>";
                htmlCode+="</p>";
                $("#TOOL").append(htmlCode);
            }
        }
    );
}