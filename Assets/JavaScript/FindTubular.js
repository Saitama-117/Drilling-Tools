/*
 * The document ready function which runs automatically after the HTML page is loaded.
 */
$(function()
    {
        //set up the click handler of the search button.
        $("#searchTool").click(function()
            {
                searchTooltoDatabase();
            }
        );

        //populate tubular radio checkbox lists after the page is loaded
        populateTubularCheckBoxList();

    } //end document ready function
);

/*
 *Function to handle search button.
 */
function searchTooltoDatabase()
{
    var tubularID= $("input[name='tubularID']:checked").val();
    var pressure=$("#PRESSURE").val();
    var temperature=$("#TEMPERATURE").val();
    var restriction=$("#RESTRICTION").val();

    var url="./Assets/AjaxServices/read-cuts.php";              //request URL
    var data={  "tubularID":tubularID,
                "temperature":temperature,
                "pressure":pressure,
                "restriction":restriction};

//send Ajax request
    $.getJSON(url, data, function(result)
        {
            $("#TOOLS").empty();            //remove all children first

            if (result.message === 'Validation Passed') {
                // Input data passed validation
                var tools = result.tools;
                if (tools.length > 0) {
                    for (var index in tools)       //iterate through the reply (in JSON)
                    {
                        var tool=tools[index];
                        var htmlCode="<p>";
                        htmlCode+="OD: "+tool["OD"]+" in, Min Temp: "+tool["minTemp"]+" &#8451, Max Temp: "+tool["maxTemp"]+" &#8451, ";
                        htmlCode+="Min Pressure: "+tool["minPressure"]+" psi, Max Pressure: "+tool["maxPressure"]+"psi</p>";
                        if (tool["CADurl"]) {
                            htmlCode+="<div class='iframe-container'>";
                            htmlCode+="<iframe id='3dviewerplayer' type='text/html'";
                            htmlCode+="src='"+tool["CADurl"]+"' frameborder='0' scrolling='no' allowfullscreen webkitallowfullscreen mozallowfullscreen><p>Your browser does not support iframes.</p></iframe>";
                            htmlCode+="</div>";
                        }

                        htmlCode+="<hr class='one'>"; //horizontal lines btw tools
                        $("#TOOLS").append(htmlCode);
                    }
                } else {
                    htmlCode="<p>Sorry - no tools available</p>";
                    $("#TOOLS").append(htmlCode);
                }
            } else {
                // Input data did not pass validation
                var htmlCode="<p>Please Correct Input Data</p>";
                $("#TOOLS").append(htmlCode);
            }
        } //end callback function
    ); //end function call
} //end function

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
                htmlCode+="<input class='w3-check' type='radio' name='tubularID' value='"+ tubular["tubularID"]+"'>";
                htmlCode+="<label>OD: "+tubular["OD"]+" in, ID: "+tubular["ID"]+" in, Weight: "+tubular["weight"]+" ppf</label>";
                htmlCode+="</p>";
                $("#TUBULAR").append(htmlCode);
            }
        }
    );
}