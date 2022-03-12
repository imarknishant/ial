function yesnoCheck() {
  if (document.getElementById('yesCheck').checked) {
    document.getElementById('withdraw-grp').style.display = 'block';
  } else document.getElementById('withdraw-grp').style.display = 'none';
}
(function ($) {

  'use strict';

  jQuery('.opp_top_list li.dropdown').on('hide.bs.dropdown', function (e) {
    if (e.clickEvent) {
      e.preventDefault();
    }
  });

  // form-edit

  // var inputTitle = $( ".form-control" ).attr( "disabled" );

  //  $('.edit_btn').click(function(){
  //       $(this).parents('.profile-content').find('.profile_form').toggleClass('disabled_form');
  //       $(this).parents('.profile-content').find('.profile_edit_form').toggleClass('edit_form');
  //  });


  // Custom scroll bar
  $(window).on("load", function () {
    $('.loades').hide();
    $(".cmScroll, #Main").mCustomScrollbar({
      theme: "minimal",
      scrollInertia: 2000
    });
    // $('body').append('<div class="loading"><div class="ldio"><div></div></div></div>')
  });

  $('.toggleBtn').click(function () {
    $('#Main').toggleClass('open');
  });
  $('#mobile-show .btn').click(function () {
    $('.search-form-main').toggleClass('active-search');
    $('.search-form-main .search-field').focus();
  });

  $('.main__slider__slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.main__slider__nav'
  });

  $('.main__slider__nav').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    vertical: true,
    asNavFor: '.main__slider__slider',
    dots: false,
    focusOnSelect: true,
    verticalSwiping: true,
    prevArrow: '<a href="#" class="slick-prev slick-arrow"><i class="material-icons">keyboard_arrow_up</i></a>',
    nextArrow: '<a href="#" class="slick-next slick-arrow"><i class="material-icons">keyboard_arrow_down</i></a>',
    responsive: [{
        breakpoint: 1199,
        settings: {
          vertical: true,
          slidesToShow: 4
        }
      },
      {
        breakpoint: 992,
        settings: {
          vertical: false,
            prevArrow: '<a href="#" class="slick-prev slick-arrow"><i class="material-icons">chevron_left</i></a>',
            nextArrow: '<a href="#" class="slick-next slick-arrow"><i class="material-icons">navigate_next</i></a>',
          slidesToShow: 3
        }
      },
      {
        breakpoint: 768,
        settings: {
          vertical: false,
           prevArrow: '<a href="#" class="slick-prev slick-arrow"><i class="material-icons">chevron_left</i></a>',
            nextArrow: '<a href="#" class="slick-next slick-arrow"><i class="material-icons">navigate_next</i></a>',
          slidesToShow: 2
        }
      }
    ]
  });


  $('.catogery__slidr').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    dots: false,
    autoplay: true,
    focusOnSelect: true,
    prevArrow: '<a href="#" class="slick-prev slick-arrow"><i class="material-icons">chevron_left</i></a>',
    nextArrow: '<a href="#" class="slick-next slick-arrow"><i class="material-icons">navigate_next</i></a>',
    responsive: [{
        breakpoint: 1199,
        settings: {
          slidesToShow: 4
        }
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 3
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2
        }
      }
    ]
  });

  $(".drop-share").hover(function () {
    var isHovered = $(this).is(":hover");
    if (isHovered) {
      $(this).children(".social-icon").stop().slideDown(300);
    } else {
      $(this).children(".social-icon").stop().slideUp(300);
    }
  });

  // button     = document.querySelector( "input[type='file']" ),
  // the_return = document.querySelector( ".out");

  // button.addEventListener( "click", function( event ) {
  //   the_return.innerHTML = this.value; 
  // });  
  // fileInput.addEventListener( "change", function( event) {  
  //   the_return.innerHTML = this.value;  
  // });  

  // $('a[href],button, .radio-custom').attr("cursor-class","arrow");


//  $('.btn').click(function () {
//    var $this = $(this);
//
//    if ($this.text() == 'VOTE') {
//      $this.text('VOTED');
//      $this.addClass('active');
//    }
//  });


  //  $(window).ready(function () {
  //    $('#sign-upp').modal('show')
  //
  //  })

  // // mouse custom

  // const cursor = document.querySelector('#cursor');
  // const cursorCircle = cursor.querySelector('.cursor__circle');

  // const mouse = { x: -100, y: -100 }; // mouse pointer's coordinates
  // const pos = { x: 0, y: 0 }; // cursor's coordinates
  // const speed = 0.1; // between 0 and 1

  // const updateCoordinates = e => {
  //   mouse.x = e.clientX;
  //   mouse.y = e.clientY;
  // };

  // window.addEventListener('mousemove', updateCoordinates);


  // function getAngle(diffX, diffY) {
  //   return Math.atan2(diffY, diffX) * 180 / Math.PI;
  // }

  // function getSqueeze(diffX, diffY) {
  //   const distance = Math.sqrt(
  //     Math.pow(diffX, 2) + Math.pow(diffY, 2)
  //   );
  //   const maxSqueeze = 0.15;
  //   const accelerator = 1500;
  //   return Math.min(distance / accelerator, maxSqueeze);
  // }


  // const updateCursor = () => {
  //   const diffX = Math.round(mouse.x - pos.x);
  //   const diffY = Math.round(mouse.y - pos.y);

  //   pos.x += diffX * speed;
  //   pos.y += diffY * speed;

  //   const angle = getAngle(diffX, diffY);
  //   const squeeze = getSqueeze(diffX, diffY);

  //   const scale = 'scale(' + (1 + squeeze) + ', ' + (1 - squeeze) +')';
  //   const rotate = 'rotate(' + angle +'deg)';
  //   const translate = 'translate3d(' + pos.x + 'px ,' + pos.y + 'px, 0)';

  //   cursor.style.transform = translate;
  //   cursorCircle.style.transform = rotate + scale;
  // };

  // function loop() {
  //   updateCursor();
  //   requestAnimationFrame(loop);
  // }

  // requestAnimationFrame(loop);



  // const cursorModifiers = document.querySelectorAll('[cursor-class]');

  // cursorModifiers.forEach(curosrModifier => {
  //   curosrModifier.addEventListener('mouseenter', function() {
  //     const className = this.getAttribute('cursor-class');
  //     cursor.classList.add(className);
  //   });

  //   curosrModifier.addEventListener('mouseleave', function() {
  //     const className = this.getAttribute('cursor-class');
  //     cursor.classList.remove(className);
  //   });
  // });
  // custom video player

  //ELEMENT SELECTORS
  var player = document.querySelector('.player');
  var video = document.querySelector('#video');
  var playBtn = document.querySelector('.play-btn');
  var volumeBtn = document.querySelector('.volume-btn');
  var volumeSlider = document.querySelector('.volume-slider');
  var volumeFill = document.querySelector('.volume-filled');
  var progressSlider = document.querySelector('.progress');
  var progressFill = document.querySelector('.progress-filled');
  var textCurrent = document.querySelector('.time-current');
  var textTotal = document.querySelector('.time-total');
  var speedBtns = document.querySelectorAll('.speed-item');
  var fullscreenBtn = document.querySelector('.fullscreen');

  //GLOBAL VARS
  let lastVolume = 1;
  let isMouseDown = false;

  //PLAYER FUNCTIONS
  function togglePlay() {
    if (video.paused) {
      video.play();
    } else {
      video.pause();
    }
    playBtn.classList.toggle('paused');
  }

  function togglePlayBtn() {
    playBtn.classList.toggle('playing');
  }

  function toggleMute() {
    if (video.volume) {
      lastVolume = video.volume;
      video.volume = 0;
      volumeBtn.classList.add('muted');
      volumeFill.style.width = 0;
    } else {
      video.volume = lastVolume;
      volumeBtn.classList.remove('muted');
      volumeFill.style.width = `${lastVolume*100}%`;
    }
  }

  function changeVolume(e) {
    volumeBtn.classList.remove('muted');
    let volume = e.offsetX / volumeSlider.offsetWidth;
    volume < 0.1 ? volume = 0 : volume = volume;
    volumeFill.style.width = `${volume*100}%`;
    video.volume = volume;
    if (volume > 0.7) {
      volumeBtn.classList.add('loud');
    } else if (volume < 0.7 && volume > 0) {
      volumeBtn.classList.remove('loud');
    } else if (volume == 0) {
      volumeBtn.classList.add('muted');
    }
    lastVolume = volume;
  }

  function neatTime(time) {
    // var hours = Math.floor((time % 86400)/3600)
    var minutes = Math.floor((time % 3600) / 60);
    var seconds = Math.floor(time % 60);
    seconds = seconds > 9 ? seconds : `0${seconds}`;
    return `${minutes}:${seconds}`;
  }

  function updateProgress(e) {
    progressFill.style.width = `${video.currentTime/video.duration*100}%`;
    textCurrent.innerHTML = `${neatTime(video.currentTime)} / ${neatTime(video.duration)}`;
    // textTotal.innerHTML = neatTime(video.duration);
    // console.log(progressFill.style.width);
  }

  function setProgress(e) {
    const newTime = e.offsetX / progressSlider.offsetWidth;
    progressFill.style.width = `${newTime*100}%`;
    video.currentTime = newTime * video.duration;
  }

  function launchIntoFullscreen(element) {
    if (element.requestFullscreen) {
      element.requestFullscreen();
    } else if (element.mozRequestFullScreen) {
      element.mozRequestFullScreen();
    } else if (element.webkitRequestFullscreen) {
      element.webkitRequestFullscreen();
    } else if (element.msRequestFullscreen) {
      element.msRequestFullscreen();
    }
  }

  function exitFullscreen() {
    if (document.exitFullscreen) {
      document.exitFullscreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
      document.webkitExitFullscreen();
    }
  }
  var fullscreen = false;

  function toggleFullscreen() {
    fullscreen ? exitFullscreen() : launchIntoFullscreen(player)
    fullscreen = !fullscreen;
  }

  function setSpeed(e) {
    console.log(parseFloat(this.dataset.speed));
    video.playbackRate = this.dataset.speed;
    speedBtns.forEach(speedBtn => speedBtn.classList.remove('active'));
    this.classList.add('active');
  }

  function handleKeypress(e) {
    switch (e.key) {
      case " ":
        togglePlay();
      case "ArrowRight":
        video.currentTime += 5;
      case "ArrowLeft":
        video.currentTime -= 5;
      default:
        return;
    }
  }
  //EVENT LISTENERS
  if(playBtn != null){
    playBtn.addEventListener('click', togglePlay);    
  }
  
  if(video != null){
    video.addEventListener('click', togglePlay);
      video.addEventListener('play', togglePlayBtn);
      video.addEventListener('pause', togglePlayBtn);
      video.addEventListener('ended', togglePlayBtn);
      video.addEventListener('timeupdate', updateProgress);
      video.addEventListener('canplay', updateProgress);    
  }
  
  if(volumeBtn != null){
    volumeBtn.addEventListener('click', toggleMute);    
  }
  
  window.addEventListener('mousedown', () => isMouseDown = true)
  window.addEventListener('mouseup', () => isMouseDown = false)
  // volumeSlider.addEventListener('mouseover', changeVolume);
  
  if(volumeSlider != null){
    volumeSlider.addEventListener('click', changeVolume);    
  }
  
  if(progressSlider != null){
    progressSlider.addEventListener('click', setProgress);    
  }
  
  if(fullscreenBtn != null){
    fullscreenBtn.addEventListener('click', toggleFullscreen);    
  }
  
  if(speedBtns != null){
    speedBtns.forEach(speedBtn => {
    speedBtn.addEventListener('click', setSpeed);
  })    
  }
  
  window.addEventListener('keydown', handleKeypress);



  AOS.init();


  //Avoid pinch zoom on iOS
  document.addEventListener('touchmove', function (event) {
    if (event.scale !== 1) {
      event.preventDefault();
    }
  }, false);



  $("a.material-icons").each(function () {
    var $this = $(this);
    var targetM = $this.siblings('video');
    var currentPos = targetM.get(0).currentTime; //Get currenttime
    // var currentTime = targetM.get(0).currentTime = maxduration * percentage / 100;
    var maxduration = targetM.get(0).duration; //Get video duration

    $('.duration').html(maxduration);

    $this.on('click', function () {

      if (targetM.get(0).paused) {
        targetM.get(0).play();
        $this.siblings('.duration').html(currentPos);
        $this.html('pause_circle_filled');
      } else {
        targetM.get(0).pause();
        $this.siblings('.duration').html(maxduration);
        // $this.html('play_circle'); 
      }
      return false;
    });

  });


})(jQuery)