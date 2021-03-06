/*
 * The document ready function which runs automatically after the HTML page is loaded.
 */
$(function()
    {
        // Set up the click handler of the update tubular button
        $("#update-tubular").click(function () {
            modifyTubularInDatabase();
            }
        );

        // Set up the click handler of the update tubular button
        $("#update-tool").click(function () {
            modifyToolToDatabase();
            }
        );

        // Set up the click handler of the update tubular button
        $("#link-tool-tubular").click(function () {
                addCutToDatabase();
            }
        );

        // Setup onchange handler for populating selected tool data
        $("#tool-list").change(function() {
            populateToolData();
        });

        // Setup onchange handler for populating selected tubular data
        $("#tubular-list").change(function() {
            populateTubularData();
        });

        //populate radio checkbox lists after the page is loaded
        populateTubularCheckBoxList();
        populateToolRadioList();
        populateAvailableLinks();
    }
);

/*
    Function to populate the available cuts
 */
function populateAvailableLinks() {
    var url="./Assets/AjaxServices/read-available-links.php";
    var data = {};
    var htmlCode = "<tr>";
    htmlCode += "<th>Tools</th>";
    htmlCode += "<th>Tubulars</th>";
    htmlCode += "</tr>";

    $.get(url, data, function (result) {
        console.log(result);
        var availableLinks = result;
        if(availableLinks.length != 0){
            $("#available-links").empty();
            for(var index in availableLinks){
                var link = availableLinks[index];
                htmlCode += "<tr>";
                htmlCode += "<td>OD: "+link["toolOD"]+" in, Min Temp: "+link["minTemp"]+" &#8451, Max Temp: "+link["maxTemp"]+" &#8451, ";
                htmlCode += " Min Pressure: "+link["minPressure"]+" psi, Max Pressure: "+link["maxPressure"]+"psi</td>";
                htmlCode += "<td>OD: "+link["OD"]+" in, ID: "+link["ID"]+" in, Weight: "+link["weight"]+" ppf</td>";
                htmlCode += "</tr>";
            }
            $("#available-links").append(htmlCode);
        }

    })
}

/*
    Function to populate selected tool data
 */
function populateToolData() {

    var toolId = $("#tool-list").val();

    var url="./Assets/AjaxServices/get-tool-by-id.php";
    var data={
        "tool-id" : toolId
    };
    $.get(url, data, function (result) {
        var toolData = JSON.parse(result);
        $("#tool-id").val(toolId);
        $("#toolOD").val(toolData.OD);
        $("#minPressure").val(toolData.minPressure);
        $("#maxPressure").val(toolData.maxPressure);
        $("#minTemp").val(toolData.minTemp);
        $("#maxTemp").val(toolData.maxTemp);
        $("#CADurl").val(toolData.CADurl);
        
    });
}

/*
    Function to populate the selected tubular data
 */
function populateTubularData() {
    var tubularId = $("#tubular-list").val();
    var url="./Assets/AjaxServices/get-tubular-by-id.php";
    var data={
        "tubular-id" : tubularId
    };

    $.get(url, data, function (result) {
        var tubularData = JSON.parse(result);
        $("#tubular-id").val(tubularId);
        $("#tubularOD").val(tubularData.OD);
        $("#tubularID").val(tubularData.ID);
        $("#weight").val(tubularData.weight);
    });
}

/*
 *Function to handle update tubular button
 */
function modifyTubularInDatabase()
{
    var tubularOD = $("#tubularOD").val();
    var tubularID = $("#tubularID").val();
    var weight = $("#weight").val();
    var tubularId = $("#tubular-id").val();

    if(tubularOD != ''){
        var url="./Assets/AjaxServices/update-tubular.php";
        var data={
            "tubularId" : tubularId,
            "tubularOD":tubularOD,
            "tubularID":tubularID,
            "weight":weight
        };

        $.post(url, data, function(result){
            alert(result.message);
            populateTubularCheckBoxList();
            populateAvailableLinks();
            clearTubularData();
        });
    } else {
        alert("Kindly Select Tubular");
    }


}

/*
 *Function to handle update tool button
 */
function modifyToolToDatabase()
{
    var toolOD=$("#toolOD").val();
    var minPressure=$("#minPressure").val();
    var maxPressure=$("#maxPressure").val();
    var minTemp=$("#minTemp").val();
    var maxTemp=$("#maxTemp").val();
    var toolId = $("#tool-id").val();
    var CADurl = $("#CADurl").val();

    if(toolOD != ''){
        var url="./Assets/AjaxServices/update-tools.php";
        var data={"toolOD":toolOD,
            "minPressure":minPressure,
            "maxPressure":maxPressure,
            "minTemp":minTemp,
            "maxTemp":maxTemp,
            "toolID" : toolId,
            "CADurl" :CADurl
        };

        $.post(url, data, function(result){
            console.log(result);
            alert(result.message);
            populateToolRadioList();
            populateAvailableLinks();
            clearToolData();
        });
    } else {
        alert('Kindly Select Tool');
    }

}

/*
    Function to clear populated tubular data
 */
function clearTubularData(){
    $("#tubularOD").val("");
    $("#tubularID").val("");
    $("#weight").val("");
    $("#tubular-id").val("0");
    $("#tubular-list").val("0");
}

/*
    Function to clear the populated tool data
 */
function clearToolData() {
    $("#toolOD").val("");
    $("#minPressure").val("");
    $("#maxPressure").val("");
    $("#minTemp").val("");
    $("#maxTemp").val("");
    $("#tool-id").val("0");
    $("#tool-list").val("0");
    $("#CADurl").val("");
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
        populateAvailableLinks();
    });
}


/*
Function to populate tubular checkbox list and tubular dropdown
 */
function populateTubularCheckBoxList()
{
    var url="./Assets/AjaxServices/ReadTubulars.php";
    var data={};
    var htmlCodeForDropdown = "<option value='0'> Select Tubular </option>";

        $.getJSON(  url, data,
        function(result)
        {
            $("#TUBULAR").empty();      //remove all children first
            $("#tubular-list").empty();
            for (var index in result)
            {
                var tubular=result[index];
                var htmlCode="<p>";
                htmlCode+="<input class='w3-check' type='checkbox' name='tubulars' value='"+ tubular["tubularID"]+"'>";
                htmlCode+="<label>OD: "+tubular["OD"]+" in, ID: "+tubular["ID"]+" in, Weight: "+tubular["weight"]+" ppf</label>";
                htmlCode+="</p>";
                $("#TUBULAR").append(htmlCode);

                htmlCodeForDropdown += "<option ";
                htmlCodeForDropdown += "value = '" + tubular["tubularID"] + "'>";
                htmlCodeForDropdown += "OD: "+tubular["OD"]+" in, ID: "+tubular["ID"]+" in, Weight: "+tubular["weight"]+" ppf";
                htmlCodeForDropdown += "</option>";
            }
            $("#tubular-list").append(htmlCodeForDropdown);
        }
    );
}

/*
Function to populate tool radio list and tool dropdown
 */
function populateToolRadioList()
{
    var url="./Assets/AjaxServices/ReadTools.php";
    var data={};
    var htmlCodeForDropdown = "<option value='0'> Select Tool </option>";

    $.getJSON(  url, data,
        function(result)
        {
            $("#TOOL").empty();      //remove all children first
            $("#tool-list").empty();
            for (var index in result)
            {
                var tool=result[index];
                var htmlCode="<p>";
                htmlCode+="<input class='w3-radio' type='radio' name='tool' value='"+ tool["toolID"]+"'>";
                htmlCode+="<label>OD: "+tool["OD"]+" in, Min Temp: "+tool["minTemp"]+" &#8451, Max Temp: "+tool["maxTemp"]+" &#8451, ";
                htmlCode += " Min Pressure: "+tool["minPressure"]+" psi, Max Pressure: "+tool["maxPressure"]+"psi</label>";
                htmlCode+="</p>";
                $("#TOOL").append(htmlCode);

                htmlCodeForDropdown += "<option ";
                htmlCodeForDropdown += "value = '" + tool["toolID"] + "'>";
                htmlCodeForDropdown += "OD: "+tool["OD"]+" in, Min Temp: "+tool["minTemp"]+" &#8451, Max Temp: "+tool["maxTemp"]+" &#8451, ";
                htmlCodeForDropdown += " Min Pressure: "+tool["minPressure"]+" psi, Max Pressure: "+tool["maxPressure"]+"psi";
                htmlCodeForDropdown += "</option>";
            }
            $("#tool-list").append(htmlCodeForDropdown);
        }
    );
}