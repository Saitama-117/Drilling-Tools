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

    //populate checkbox lists after the page is loaded.
    //populateTubularCheckBoxList();
    //populateToolCheckBoxList();
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
                };   //request parameters as a map

    //send Ajax request
    $.post(url, data, function(result){
        alert(result.message);
    });
    // populateTubularCheckBoxList();
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
    };   //request parameters as a map

    //send Ajax request
    $.post(url, data, function(result){
        alert(result.message);
    });
    // populateToolCheckBoxList();
}

/*
Function to populate tubular checkbox list
 */
function populateTubularCheckBoxList(keyword)
{

} //end function
