"use strict";

/******************\
 * The Slider Class
 */
var Slider = function()
{
  this.slides =
  [
    { image: "img/photo/1024x768/heic1501a.jpg", legend: "Eagle Nebula"},
    { image: "img/photo/1024x768/opo0432d.jpg", legend: "Helix Nebula"},
    { image: "img/photo/1024x768/heic0601a.jpg", legend: "Orion Nebula"},
    { image: "img/photo/1024x768/heic0515a.jpg", legend: "Crab Nebula"},
    { image: "img/photo/1024x768/heic1307a.jpg", legend: "Horsehead Nebula"},
    { image: "img/photo/1024x768/heic1310a.jpg", legend: "Ring Nebula"},
    { image: "img/photo/1024x768/heic0206c.jpg", legend: "Cone Nebula"},
    { image: "img/photo/1024x768/heic1015a.jpg", legend: "Lagoon Nebula"},
    { image: "img/photo/1024x768/heic0910h.jpg", legend: "Bug Nebula"},
    { image: "img/photo/1024x768/heic0707a.jpg", legend: "Carina Nebula"},
    { image: "img/photo/1024x768/heic0206d.jpg", legend: "Omega Nebula"},
    { image: "img/photo/1024x768/heic1105a.jpg", legend: "Tarantula Nebula"}
  ];

  this.state =
  {
    index: -1,
    timer: window.setInterval(this.onSliderNext.bind(this), 5000)
  };

  installEventListener("#slider-random", "click", this.onSliderRandom.bind(this));
  installEventListener("#slider-previous", "click", this.onSliderPrevious.bind(this));
  installEventListener("#slider-next", "click", this.onSliderNext.bind(this));
  installEventListener("#slider-toggle", "click", this.onSliderToggle.bind(this));
  installEventListener("#toolbar-toggle", "click", this.onToolbarToggle.bind(this));
};

/******************************************\
* Refreshs the Slider with the next picture
*/
Slider.prototype.onSliderNext = function(event)
{
  this.state.index++;

  if (this.state.index === this.slides.length) {
    this.state.index = 0;
  }
  this.refreshSlider();
};

/**********************************************\
* Refreshs the Slider with the previous picture
*/
Slider.prototype.onSliderPrevious = function(event)
{
  this.state.index--;

  if (this.state.index < 0) {
    this.state.index = this.slides.length - 1;
  }
  this.refreshSlider();
};

/******************************************\
* Refreshs the Slider with a random picture
*/
Slider.prototype.onSliderRandom = function(event)
{
  var index;

  do {
    index = getRandomInteger(0, this.slides.length - 1);
  }
  while (index === this.state.index);

  this.state.index = index;

  this.refreshSlider();
};

/*****************************************\
* Toggles the Slider for playback or pause
*/
Slider.prototype.onSliderToggle = function(event)
{
  var icon;
  var toggle;

  icon    = document.querySelector("#slider-toggle i");
  toggle  = document.querySelector("#slider-toggle");

  icon.classList.toggle("fa-play");
  icon.classList.toggle("fa-pause");

  if (this.state.timer == null) {
    this.state.timer = window.setInterval(this.onSliderNext.bind(this), 5000);

    toggle.title = "Pause";
  } else {
    window.clearInterval(this.state.timer);

    this.state.timer  = null;
    toggle.title      = "Lecture";
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

  icon    = document.querySelector("#toolbar-toggle i");
  toggle  = document.querySelector("#toolbar-toggle");
  nav     = document.querySelector(".slider-nav ul");

  icon.classList.toggle("fa-toggle-on");
  icon.classList.toggle("fa-toggle-off");

  nav.classList.toggle("none");

  if (nav.classList.contains("none")) {
    toggle.title = "Déplier la barre de contrôle du diaporama";
  } else {
    toggle.title = "Replier la barre de contrôle du diaporama";
  }
};

/*************************************************************\
* Refreshs the slider with the new image & the new description
*/
Slider.prototype.refreshSlider = function()
{
  var sliderImage;
  var sliderLegend;

  sliderImage  = document.querySelector("#slider img");
  sliderLegend = document.querySelector("#slider figcaption");

  sliderImage.src          = this.slides[this.state.index].image;
  sliderLegend.textContent = this.slides[this.state.index].legend;
};
