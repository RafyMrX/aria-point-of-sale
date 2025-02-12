
<div {{ $attributes }} >
    <div style="position:fixed;top: 0px;left: 0px;z-index: 9999;width: 100%;height:100%;display:flex;justify-content:center;align-items:center;background-color:#fff;opacity:.70;">
      <div style="color:#5f815e" class="la-square-loader ">
          <div></div>
      </div>
    </div>
</div>


@push('styles')
<style>
    /*!
* Load Awesome v1.1.0 (http://github.danielcardoso.net/load-awesome/)
* Copyright 2015 Daniel Cardoso <@DanielCardoso>
* Licensed under MIT
*/


.la-square-loader,
.la-square-loader > div {
  position: relative;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
}
.la-square-loader {
  display: block;
  font-size: 0;
  color: #fff;
}
.la-square-loader.la-dark {
  color: #333;
}
.la-square-loader > div {
  display: inline-block;
  float: none;
  background-color: currentColor;
  border: 0 solid currentColor;
}
.la-square-loader {
  width: 32px;
  height: 32px;
}
.la-square-loader > div {
  width: 100%;
  height: 100%;
  background: transparent;
  border-width: 2px;
  border-radius: 0;
  -webkit-animation: square-loader 2s infinite ease;
     -moz-animation: square-loader 2s infinite ease;
       -o-animation: square-loader 2s infinite ease;
          animation: square-loader 2s infinite ease;
}
.la-square-loader > div:after {
  display: inline-block;
  width: 100%;
  vertical-align: top;
  content: "";
  background-color: currentColor;
  -webkit-animation: square-loader-inner 2s infinite ease-in;
     -moz-animation: square-loader-inner 2s infinite ease-in;
       -o-animation: square-loader-inner 2s infinite ease-in;
          animation: square-loader-inner 2s infinite ease-in;
}
.la-square-loader.la-sm {
  width: 16px;
  height: 16px;
}
.la-square-loader.la-sm > div {
  border-width: 1px;
}
.la-square-loader.la-2x {
  width: 64px;
  height: 64px;
}
.la-square-loader.la-2x > div {
  border-width: 4px;
}
.la-square-loader.la-3x {
  width: 96px;
  height: 96px;
}
.la-square-loader.la-3x > div {
  border-width: 6px;
}
/*
* Animations
*/
@-webkit-keyframes square-loader {
  0% {
      -webkit-transform: rotate(0deg);
              transform: rotate(0deg);
  }
  25% {
      -webkit-transform: rotate(180deg);
              transform: rotate(180deg);
  }
  50% {
      -webkit-transform: rotate(180deg);
              transform: rotate(180deg);
  }
  75% {
      -webkit-transform: rotate(360deg);
              transform: rotate(360deg);
  }
  100% {
      -webkit-transform: rotate(360deg);
              transform: rotate(360deg);
  }
}
@-moz-keyframes square-loader {
  0% {
      -moz-transform: rotate(0deg);
           transform: rotate(0deg);
  }
  25% {
      -moz-transform: rotate(180deg);
           transform: rotate(180deg);
  }
  50% {
      -moz-transform: rotate(180deg);
           transform: rotate(180deg);
  }
  75% {
      -moz-transform: rotate(360deg);
           transform: rotate(360deg);
  }
  100% {
      -moz-transform: rotate(360deg);
           transform: rotate(360deg);
  }
}
@-o-keyframes square-loader {
  0% {
      -o-transform: rotate(0deg);
         transform: rotate(0deg);
  }
  25% {
      -o-transform: rotate(180deg);
         transform: rotate(180deg);
  }
  50% {
      -o-transform: rotate(180deg);
         transform: rotate(180deg);
  }
  75% {
      -o-transform: rotate(360deg);
         transform: rotate(360deg);
  }
  100% {
      -o-transform: rotate(360deg);
         transform: rotate(360deg);
  }
}
@keyframes square-loader {
  0% {
      -webkit-transform: rotate(0deg);
         -moz-transform: rotate(0deg);
           -o-transform: rotate(0deg);
              transform: rotate(0deg);
  }
  25% {
      -webkit-transform: rotate(180deg);
         -moz-transform: rotate(180deg);
           -o-transform: rotate(180deg);
              transform: rotate(180deg);
  }
  50% {
      -webkit-transform: rotate(180deg);
         -moz-transform: rotate(180deg);
           -o-transform: rotate(180deg);
              transform: rotate(180deg);
  }
  75% {
      -webkit-transform: rotate(360deg);
         -moz-transform: rotate(360deg);
           -o-transform: rotate(360deg);
              transform: rotate(360deg);
  }
  100% {
      -webkit-transform: rotate(360deg);
         -moz-transform: rotate(360deg);
           -o-transform: rotate(360deg);
              transform: rotate(360deg);
  }
}
@-webkit-keyframes square-loader-inner {
  0% {
      height: 0;
  }
  25% {
      height: 0;
  }
  50% {
      height: 100%;
  }
  75% {
      height: 100%;
  }
  100% {
      height: 0;
  }
}
@-moz-keyframes square-loader-inner {
  0% {
      height: 0;
  }
  25% {
      height: 0;
  }
  50% {
      height: 100%;
  }
  75% {
      height: 100%;
  }
  100% {
      height: 0;
  }
}
@-o-keyframes square-loader-inner {
  0% {
      height: 0;
  }
  25% {
      height: 0;
  }
  50% {
      height: 100%;
  }
  75% {
      height: 100%;
  }
  100% {
      height: 0;
  }
}
@keyframes square-loader-inner {
  0% {
      height: 0;
  }
  25% {
      height: 0;
  }
  50% {
      height: 100%;
  }
  75% {
      height: 100%;
  }
  100% {
      height: 0;
  }
}
  </style>
@endpush