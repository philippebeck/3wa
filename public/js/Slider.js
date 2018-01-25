// ****************** \\
// ***** SLIDER ***** \\
// ****************** \\



'use strict';



/******************\
 * The Slider Class
 */
var Slider = function()
{
  // Slides list
  this.slides =
  [
    { image: 'img/photo/1024x768/heic1501a.jpg', legend: 'Eagle Nebula'},
    { image: 'img/photo/1024x768/heic0506a.jpg', legend: 'Whirlpool Galaxy'},
    { image: 'img/photo/1024x768/opo0432d.jpg', legend: 'Helix Nebula'},
    { image: 'img/photo/1024x768/opo0328a.jpg', legend: 'Sombrero Galaxy'},
    { image: 'img/photo/1024x768/heic0601a.jpg', legend: 'Orion Nebula'},
    { image: 'img/photo/1024x768/potw1345a.jpg', legend: 'Antennae Galaxy'},
    { image: 'img/photo/1024x768/heic0515a.jpg', legend: 'Crab Nebula'},
    { image: 'img/photo/1024x768/heic1110a.jpg', legend: 'Centaurus A'},
    { image: 'img/photo/1024x768/heic1307a.jpg', legend: 'Horsehead Nebula'},
    { image: 'img/photo/1024x768/heic0710a.jpg', legend: 'Bode\'s Galaxy'},
    { image: 'img/photo/1024x768/heic1310a.jpg', legend: 'Ring Nebula'},
    { image: 'img/photo/1024x768/heic1403a.jpg', legend: 'Southern Pinwheel Galaxy'},
    { image: 'img/photo/1024x768/heic0206c.jpg', legend: 'Cone Nebula'},
    { image: 'img/photo/1024x768/opo1247a.jpg', legend: 'Hercules A'},
    { image: 'img/photo/1024x768/heic1015a.jpg', legend: 'Lagoon Nebula'},
    { image: 'img/photo/1024x768/heic0604a.jpg', legend: 'Cigar Galaxy'},
    { image: 'img/photo/1024x768/heic0910h.jpg', legend: 'Bug Nebula'},
    { image: 'img/photo/1024x768/heic0817a.jpg', legend: 'Perseus A'},
    { image: 'img/photo/1024x768/heic0707a.jpg', legend: 'Carina Nebula'},
    { image: 'img/photo/1024x768/heic0206a.jpg', legend: 'Tadpole Galaxy'},
    { image: 'img/photo/1024x768/heic0206d.jpg', legend: 'Omega Nebula'},
    { image: 'img/photo/1024x768/opo0511a.jpg', legend: 'Fornax A'},
    { image: 'img/photo/1024x768/heic1105a.jpg', legend: 'Tarantula Nebula'},
    { image: 'img/photo/1024x768/heic0206b.jpg', legend: 'Mice Galaxy'}
  ];

  // State object
  this.state =
  {
    index: -1,
    timer: window.setInterval(this.onSliderNext.bind(this), 5000)
  };

  // Install all events listeners on the slider nav
  installEventListener('#slider-random', 'click', this.onSliderRandom.bind(this));
  installEventListener('#slider-previous', 'click', this.onSliderPrevious.bind(this));
  installEventListener('#slider-next', 'click', this.onSliderNext.bind(this));
  installEventListener('#slider-toggle', 'click', this.onSliderToggle.bind(this));
  installEventListener('#toolbar-toggle', 'click', this.onToolbarToggle.bind(this));
}



/******************************************\
* Refreshs the Slider with the next picture
*/
Slider.prototype.onSliderNext = function(event)
{
  // Go the the next one
  this.state.index++;

  // Checks if we are at the end of the list
  if (this.state.index == this.slides.length)
  {
    // Coming back to the first one
    this.state.index = 0;
  }
  // Update the display
  this.refreshSlider();
};



/**********************************************\
* Refreshs the Slider with the previous picture
*/
Slider.prototype.onSliderPrevious = function(event)
{
  // Go to the previous one
  this.state.index--;

  // Checks if we are at the beginning of the list
  if (this.state.index < 0)
  {
    // Coming back to the last one
    this.state.index = this.slides.length - 1;
  }
  // Update the display
  this.refreshSlider();
};



/******************************************\
* Refreshs the Slider with a random picture
*/
Slider.prototype.onSliderRandom = function(event)
{
  var index;

  // Get a random integer to random the list
  do {
    index = getRandomInteger(0, this.slides.length - 1);
  }
  while (index == this.state.index);

  // Go the the random one
  this.state.index = index;

  // Update the display
  this.refreshSlider();
};



/*****************************************\
* Toggles the Slider for playback or pause
*/
Slider.prototype.onSliderToggle = function(event)
{
  var icon;
  var toggle;

  // Selects the slider main icon & the slider
  icon    = document.querySelector('#slider-toggle i');
  toggle  = document.querySelector('#slider-toggle');

  // Changes the slider main icon when switch on or off
  icon.classList.toggle('fa-play');
  icon.classList.toggle('fa-pause');

  // Checks if the slider is stopped
  if (this.state.timer == null)
  {
    // Sets a time interval between each slide
    this.state.timer = window.setInterval(this.onSliderNext.bind(this), 5000);

    // Changes the title to pause
    toggle.title = 'Pause';
  }
  else
  {
    // Stops the slider
    window.clearInterval(this.state.timer);

    // Resets the timer
    this.state.timer = null;

    // Changes the title to play
    toggle.title = 'Lecture';
  }
};



/******************************\
* Toggles the Slider navigation
*/
Slider.prototype.onToolbarToggle = function(event)
{
  var icon;
  var toggle;
  var nav;

  // Selects the toolbar toggle icon, the toolbar toggle & the toolbar
  icon    = document.querySelector('#toolbar-toggle i');
  toggle  = document.querySelector('#toolbar-toggle');
  nav     = document.querySelector('.slider-nav ul');

  // Changes the toolbar icon when switch on or off
  icon.classList.toggle('fa-toggle-on');
  icon.classList.toggle('fa-toggle-off');

  // Toggles the slider nav
  nav.classList.toggle('none');

  // Checks if the slider is stopped
  if (nav.classList.contains('none'))
  {
    // Changes the title to open the navbar
    toggle.title = 'Déplier la barre de contrôle du diaporama';
  }
  else
  {
    // Changes the title to close the navbar
    toggle.title = 'Replier la barre de contrôle du diaporama';
  }
};



/*************************************************************\
* Refreshs the slider with the new image & the new description
*/
Slider.prototype.refreshSlider = function()
{
  var sliderImage;
  var sliderLegend;

  // Searchs the slider img & figcaption tags
  sliderImage  = document.querySelector('#slider img');
  sliderLegend = document.querySelector('#slider figcaption');

  // Attributes the current content to the src & textContent
  sliderImage.src          = this.slides[this.state.index].image;
  sliderLegend.textContent = this.slides[this.state.index].legend;
};
