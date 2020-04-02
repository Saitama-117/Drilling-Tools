/*
 * The document ready function which runs automatically after the HTML page is loaded.
 */
$(function() {
        // Set up the click handler of the delete tubular button
        $("#delete-tubular").click(function () {
                deleteTubularInDatabase();
            }
        );

        // Set up the click handler of the delete tubular button
        $("#delete-tool").click(function () {
                deleteToolToDatabase();
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

        // Setup on click for deleting cuts
        // used delegated format due to dynamic buttons
        $(document).on("click", ".delete-buttons", function (event) {
            deleteCuts(event);
        });

        //populate lists after the page is loaded
        populateAvailableLinks();
        populateTubularList();
        populateToolList();

    }
);

/*
 *Function to handle delete tubular button
 */
function deleteCuts(event) {
    var tubularID = event.target.getAttribute("data-tubular-id");
    var toolID = event.target.getAttribute("data-tool-id");

    var url="./Assets/AjaxServices/delete-cuts.php";
    var data={
        "toolID" : toolID,
        "tubularID" : tubularID
    };

    $.post(url, data, function(result){
        var value = JSON.parse(result);
        alert(value.message);
        populateAvailableLinks();
    });

}


/*
    Function to populate the available cuts
 */
function populateAvailableLinks() {
    var url="./Assets/AjaxServices/read-available-links.php";
    var data = {};
    var htmlCode = "<tr>";
    htmlCode += "<th>Tools</th>";
    htmlCode += "<th>Tubulars</th>";
    htmlCode += "<th>Action</th>"
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
                htmlCode += "<td><button class='w3-btn w3-red delete-buttons' data-tool-id='"+ link["toolID"] +"' ";
                htmlCode += "data-tubular-id='"+ link["tubularID"] +"'>Delete</button></td>";
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
 *Function to handle delete tubular button
 */
function deleteTubularInDatabase() {
    var tubularId = $("#tubular-id").val();

    if(tubularId != ''){
        var url="./Assets/AjaxServices/delete-tubulars.php";
        var data={
            "tubularID" : tubularId,
        };

        $.post(url, data, function(result){
            alert(JSON.parse(result).message);
            populateTubularList();
            populateAvailableLinks();
            clearTubularData();
        });
    } else {
        alert("Kindly Select Tubular");
    }


}

/*
 *Function to handle delete tool button
 */
function deleteToolToDatabase() {
    var toolId = $("#tool-id").val();

    if(toolId != ''){
        var url="./Assets/AjaxServices/delete-tools.php";
        var data={
            "toolID" : toolId
        };

        $.post(url, data, function(result){

            alert(JSON.parse(result).message);
            populateToolList();
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
}

/*
Function to populate tubular dropdown
 */
function populateTubularList() {
    var url="./Assets/AjaxServices/ReadTubulars.php";
    var data={};
    var htmlCodeForDropdown = "<option value='0'> Select Tubular </option>";

    $.getJSON(  url, data,
        function(result) {
            $("#tubular-list").empty();      //remove all children first
            for (var index in result) {
                var tubular=result[index];
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
Function to  tool dropdown
 */
function populateToolList() {
    var url="./Assets/AjaxServices/ReadTools.php";
    var data={};
    var htmlCodeForDropdown = "<option value='0'> Select Tool </option>";

    $.getJSON(  url, data,
        function(result) {
            $("#tool-list").empty();      //remove all children first
            for (var index in result) {
                var tool=result[index];
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