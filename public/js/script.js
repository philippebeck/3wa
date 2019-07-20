// *********************** \\
// ***** MAIN SCRIPT ***** \\
// *********************** \\


// Strict mode
'use strict';


document.addEventListener('DOMContentLoaded', function(e)
{
  // Checks if we are on the Photo page
  if (typeof Slider != 'undefined')
  {
    // Creates the object slider
    var slider = new Slider();

    // Launch the slider
    slider.onSliderNext();
  }
});
