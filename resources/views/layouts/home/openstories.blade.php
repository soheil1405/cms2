  <style>


      body.paused {
          user-select: none;
          -webkit-user-select: none;
          -webkit-touch-callout: none;
          text-size-adjust: none;
          -webkit-text-size-adjust: none;
          touch-action: manipulation;
      }


      /* Original made in SCSS and TS */
      /* https://github.com/psilva999/stories-sabaton */
      :root {
          --color: rgba(233, 232, 232, 0.2);
      }

      @-webkit-keyframes code {
          0% {
              opacity: 0.1;
          }

          50% {
              opacity: 1;
          }

          100% {
              opacity: 0.1;
          }
      }

      @keyframes code {
          0% {
              opacity: 0.1;
          }

          50% {
              opacity: 1;
          }

          100% {
              opacity: 0.1;
          }
      }

      @-webkit-keyframes thumb {
          to {
              transform: initial;
          }
      }

      @keyframes thumb {
          to {
              transform: initial;
          }
      }

      @-webkit-keyframes opacity-one {
          from {
              opacity: 0;
          }

          to {
              opacity: 1;
          }
      }

      @keyframes opacity-one {
          from {
              opacity: 0;
          }

          to {
              opacity: 1;
          }
      }

      * {
          padding: 0;
          border: 0;
          margin: 0;
          box-sizing: border-box;
      }

      body i {
          opacity: 1;
          z-index: 100;
          position: absolute;
      }

      body a {
          text-decoration: none;
      }
 main {
          display: grid;
          place-items: center;
          background: #1a1b1c;
          overflow: hidden;
      }

      main {
          position: fixed;
          z-index: 1000000000;
            width: 100%;
            height: 100%;

      }

      main #slide,
      main article {
          display: grid;
      }

      :root {
          --color: rgba(233, 232, 232, 0.2);
      }

      @keyframes code {
          0% {
              opacity: 0.1;
          }

          50% {
              opacity: 1;
          }

          100% {
              opacity: 0.1;
          }
      }

      @keyframes thumb {
          to {
              transform: initial;
          }
      }

      @keyframes opacity-one {
          from {
              opacity: 0;
          }

          to {
              opacity: 1;
          }
      }

      article {
          grid-area: 1/1;
      }

      article>* {
          grid-area: 1/1;
          opacity: 0;
          visibility: none;
      }

      article>.active {
          opacity: 1;
          visibility: visible;
      }

      article>.active figcaption {
          -webkit-animation: opacity-one 0.2s linear forwards;
          animation: opacity-one 0.2s linear forwards;
      }

      article img,
      article video {
          -o-object-fit: cover;
          object-fit: cover;
          display: block;
          outline: none;
      }

      article img {
          width: 100vw;
          height: 100vh;
          -o-object-fit: cover;
          object-fit: cover;
          display: block;
          outline: none;
          /* filter: brightness(60%); */
      }

      article a {
          /* width: 100vw;
          height: 100vh;
          filter: brightness(60%); */
      }
      article video {
          filter: brightness(70%);
      }

      article figure,
      article video {
          height: 100vh;
          width: 31rem;
      }

      article figcaption {
          position: relative;
          z-index: 2;
          top: -6rem;
          left: 0.25rem;
          font-weight: 800;
          letter-spacing: 0.25rem;
          font-size: 3.7rem;
      }

      :root {
          --color: rgba(233, 232, 232, 0.2);
      }

      @keyframes code {
          0% {
              opacity: 0.1;
          }

          50% {
              opacity: 1;
          }

          100% {
              opacity: 0.1;
          }
      }

      @keyframes thumb {
          to {
              transform: initial;
          }
      }

      @keyframes opacity-one {
          from {
              opacity: 0;
          }

          to {
              opacity: 1;
          }
      }

      #slide-controls {
          grid-area: 1/1;
          display: grid;
          grid-template-columns: 0.6fr 1.4fr;
          position: relative;
      }

      #slide-controls header {
          z-index: 1;
          display: grid;
          place-items: center;
          position: absolute;
          gap: 0.15rem;
      }

      #slide-controls header,
      #slide-controls header div {
          width: 100%;
      }

      #slide-controls header div {
          display: flex;
      }

      #slide-controls header div:last-child {
          justify-content: space-between;
          align-items: center;
      }

      #slide-controls header #slide-thumb>span {
          display: block;
          border-radius: 4px;
          margin: 7px 3px;
          flex: 1;
          height: 4px;
          background: rgba(233, 232, 232, 0.2);
          overflow: hidden;
          isolation: isolate;
      }

      #slide-controls header .thumb-item.active {
          display: block;
          height: inherit;
          border-radius: 4px;
          transform: translateX(-100%);
          background: #e9e8e8;
          -webkit-animation: thumb forwards linear running;
          animation: thumb forwards linear running;
      }

      #slide-controls header .thumb-item.paused {
          -webkit-animation-play-state: paused;
          animation-play-state: paused;
      }

      #slide-controls header h1 {
          font-size: 1.3rem;
          margin-left: 0.25rem;
          letter-spacing: 0.125rem;
      }

      #slide-controls header h1,
      #slide-controls header h1:after {
          font-weight: 400;
      }

      #slide-controls header h1:after {
          content: "_";
          font-size: 1.5rem;
          margin-top: -0.25rem;
          position: absolute;
          -webkit-animation: code 2.7s linear infinite;
          animation: code 2.7s linear infinite;
      }

      #slide-controls header #play-pause {
          cursor: pointer;
          display: block;
          position: relative;
          right: 4px;
          top: 0.5px;
          opacity: 0.8;
      }

      #slide-controls header #play-pause.play {
          width: 0;
          height: 0;
          border: 8px solid rgba(0, 0, 0, 0);
          border-top: 0;
          border-bottom: 14px solid #e9e8e8;
          transform: rotate(89deg);
      }

      #slide-controls header #play-pause.pause {
          width: 1.5rem;
          height: 1rem;
      }

      #slide-controls header #play-pause.pause:after,
      #slide-controls header #play-pause.pause:before {
          content: "";
          position: absolute;
          height: 1rem;
          width: 2.5px;
          background: #e9e8e8;
      }

      #slide-controls header #play-pause.pause:before {
          margin-left: 9px;
      }

      #slide-controls header #play-pause.pause:after {
          margin-left: 17px;
      }

      #slide-controls button {
          outline: none;
          -webkit-appearance: none;
          -moz-appearance: none;
          appearance: none;
          opacity: 0;
          -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
      }

      #slide-controls #more {
          opacity: 1;
          display: none;
          position: absolute;
          color: #e9e8e8;
          text-decoration: none;
          font-weight: 300;
          z-index: 2;
          opacity: 0.6;
          transition: 0.2s;
          border-radius: 0.25rem 0 0 0.25rem;
          letter-spacing: 0.175rem;
          padding: 0.25rem 1.3rem 1rem 1.3rem;
          font-size: 1.3rem;
          bottom: 1.5rem;
          margin-left: 12.7rem;
      }

      #slide-controls #more.active {
          display: block;
      }

      #slide-controls #more:after {
          content: ">";
          display: block;
          position: absolute;
          font-size: 1.7rem;
          font-weight: 200;
          transform: rotate(90deg);
          margin-left: 1rem;
          margin-top: -0.2rem;
          -webkit-animation: code 2.7s linear infinite;
          animation: code 2.7s linear infinite;
      }

      @media (max-width: 625px) {

          article figure,
          article video {
              width: 100vw;
          }

          #slide-controls #more {
              margin-top: auto;
              margin-left: 41%;
              bottom: 2.5rem;
          }
      }

      @media (max-width: 500px) {
          article figcaption {
              font-size: 2rem;
              top: -5rem;
              letter-spacing: 0.15rem;
          }
      }

      @media (min-height: 800px) {

          article figure,
          article video {
              height: 40rem !important;
          }

          #slide-controls #more {
              margin-top: 35.3rem;
          }
      }

      @media (max-height: 600px) {
          article figcaption {
              font-size: 2rem;
              top: -5rem;
              letter-spacing: 0.15rem;
          }
      }


      

      /*# sourceMappingURL=app.min.css.map */
  </style>
  <!-- <link rel="stylesheet" href="./css/style.css"> -->


  <main id="storyMain" style="display: none;">
    <span onclick="closeStory()">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-x-square-fill" viewBox="0 0 16 16">
            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
        </svg>
    </span>
    <a className="more"  href="" style="padding:50px; font-size: 25px; color:white;" id="vendorName" target="_blank"></a>
    <section id="slide" >

          <article id="slide-elements">

          </article>


          <div id="slide-controls">
              <header style="background-color: #1a1b1ccb;">

                  <div id="slide-thumb"
                  ></div>
                  <div>

                  </div>



                  <p class="play-pause pause d-none" id="play-pause" style="display: none;"></p>
                  </div>
              </header>

          </div>
      </section>
  </main>
<script>
    
    function closeStory() {
          localStorage.clear();
          $('#storyMain').css('display', 'none');


          const myNode = document.getElementById("slide-elements");
          myNode.innerHTML = '';
          const myNode2 = document.getElementById("slide-thumb");
          myNode2.innerHTML = '';

      }
</script>



<script>
    function openStory(id, i) {
        
        
        formData = {
            'id': id,
            'andis': i
        };
        var slide = document.querySelector("#slide-elements");

        

        $.ajax({

            type: "POST",
            url: "/getstories",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {

console.log('asdasdasd');

                window.offsetTop =0;







                data.stories.forEach(element => {
                    var figure = document.createElement("figure");
                    var a = document.createElement('a');
                    a.setAttribute("href", 'https://instabargh.com/' + element.vendorName +
                        '/products/' + element.productSlug);
                    var img = document.createElement('img');
                    img.setAttribute("src", "https://instabargh.com/upload/files/products/images/" +
                        element.media);
                    img.id = "imgiddd";
                    a.appendChild(img);
                    var txt1 = document.createElement('p');
                    txt1.innerHTML = element.text1;
                    var txt2 = document.createElement('p');
                    txt2.innerHTML = element.text2;
                    figure.appendChild(txt1);
                    figure.appendChild(a);
                    figure.appendChild(txt2);
                    slide.appendChild(figure);
                    $('#storyMain').css('display', 'block');
                    figure.id = "more";


                    document.querySelector("#vendorName").setAttribute("href",
                        'https://instabargh.com/' + element.vendorName);
                    $('#vendorName').html(element.vendorName);

                });





                slide.firstElementChild.className = "active";



                var Slide = (function() {
                        function t(t, e, s, i, n) {


                            



                            void 0 === n && (n = 5e3),
                                (this.container = t),
                                (this.elements = e),
                                (this.controls = s),
                                (this.playPause = i),
                                (this.time = n),
                                (this.timeout = null),
                                (this.pausedTimeout = null),
                                (this.index = localStorage.getItem("activeStories") ?
                                    Number(localStorage.getItem("activeStories")) :
                                    0),
                                (this.slide = this.elements[this.index]),
                                (this.paused = !1),
                                (this.thumbItems = null),
                                (this.thumb = null),

                                this.init();

                        }
                        return (
                            (t.prototype.hide = function(t) {
                                var e = document.querySelector("#more");
                                (null == e ? void 0 : e.classList.contains("active")) &&
                                (null == e || e.classList.remove("active")),
                                t.classList.remove("active"),
                                    t instanceof HTMLVideoElement &&
                                    (t.pause(), (t.muted = !0), (t.currentTime = 0));

                            }),
                            (t.prototype.show = function(t) {


                                var e = this;
                                (this.index = t),


                                (this.slide = this.elements[this.index]),
                                localStorage.setItem("activeStories", String(this.index)),
                                    this.thumbItems &&
                                    ((this.thumb = this.thumbItems[this.index]),
                                        this.thumbItems.forEach(function(t) {
                                            return t.classList.remove("active");
                                        }),
                                        this.thumb.classList.add("active")),
                                    this.elements.forEach(function(t) {
                                        return e.hide(t);
                                    }),
                                    this.slide.classList.add("active"),
                                    this.slide instanceof HTMLVideoElement ?
                                    this.autoVideo(this.slide) :
                                    this.auto(this.time);
                            }),
                            (t.prototype.autoVideo = function(t) {
                                var e = this,
                                    s = document.querySelector("#more");
                                (null == s ? void 0 : s.classList.contains("active")) ||
                                null == s ||
                                    s.classList.add("active"),
                                    t.play(),
                                    (t.muted = !1);
                                var i = !0;
                                t.addEventListener("playing", function() {
                                    i && e.auto(1e3 * t.duration), (i = !1);
                                });
                            }),
                            (t.prototype.auto = function(t) {


                                    var e,
                                        s = this;
                                    null === (e = this.timeout) || void 0 === e || e.clear(),
                                        (this.timeout = new Timeout(function() {
                                            return s.next();
                                        }, t)),
                                        this.thumb &&
                                        (this.thumb.style.animationDuration = "".concat(t, "ms")

                                        );





                                }








                            ),
                            (t.prototype.prev = function() {
                                if (!this.paused) {
                                    var t =
                                        this.index - 1 >= 0 ?
                                        this.index - 1 :
                                        this.elements.length - 1;
                                    this.show(t);

                                }

                            }),
                            (t.prototype.next = function() {
                                if (!this.paused) {
                                    var t =
                                        this.index + 1 < this.elements.length ? this.index + 1 :
                                        0;

                                    this.show(t);



                                }



                
                            }),
                            (t.prototype.pause = function() {
                                var t = this;
                                document.body.classList.add("paused"),
                                    //   (window.oncontextmenu = function() {
                                    //       return !1;
                                    //   }),
                                    (this.pausedTimeout = new Timeout(function() {
                                        var e, s;
                                        null === (e = t.timeout) || void 0 === e || e
                                            .pause(),
                                            (t.paused = !0),
                                            null === (s = t.thumb) ||
                                            void 0 === s ||
                                            s.classList.add("paused"),
                                            t.slide instanceof HTMLVideoElement && t
                                            .slide.pause(),
                                            t.playPause.classList.contains("pause") &&
                                            (t.playPause.classList.remove("pause"),
                                                t.playPause.classList.add("play"));
                                    }, 300));
                            }),
                            (t.prototype.continue = function() {
                                var t, e, s;
                                document.body.classList.remove("paused"),
                                    null === (t = this.pausedTimeout) || void 0 === t || t
                                    .clear(),
                                    this.paused &&
                                    ((this.paused = !1),
                                        null === (e = this.timeout) || void 0 === e || e
                                        .continue(),
                                        null === (s = this.thumb) ||
                                        void 0 === s ||
                                        s.classList.remove("paused"),
                                        this.slide instanceof HTMLVideoElement && this.slide
                                        .play()),
                                    this.playPause.classList.contains("play") &&
                                    (this.playPause.classList.remove("play"),
                                        this.playPause.classList.add("pause"));
                            }),
                            (t.prototype.addControl = function() {
                                var t = this,
                                    e = document.createElement("button"),
                                    s = document.createElement("button");
                                (e.innerText = "Prev Slide"),
                                (s.innerText = "Next Slide"),
                                this.controls.appendChild(e),
                                    this.controls.appendChild(s),
                                    this.controls.addEventListener("pointerdown", function() {
                                        return t.pause();
                                    }),
                                    this.playPause.addEventListener("pointerdown", function() {
                                        t.playPause.classList.contains("pause") && t
                                            .pause(),
                                            t.playPause.classList.contains("play") && t
                                            .continue();
                                    }),
                                    this.playPause.addEventListener("pointerup", function() {
                                        if (
                                            !t.playPause.classList.contains("pause") &&
                                            t.playPause.classList.contains("play")
                                        )
                                            return;
                                    }),
                                    document.addEventListener("pointerup", function() {
                                        return t.continue();
                                    }),
                                    document.addEventListener("touchend", function() {
                                        return t.continue();
                                    }),
                                    e.addEventListener("pointerup", function() {
                                        return t.prev();
                                    }),
                                    s.addEventListener("pointerup", function() {
                                        return t.next();
                                    });
                            }),
                            (t.prototype.addThumbItems = function() {
                                var t = document.getElementById("slide-thumb");
                                if (t) {
                                    for (var e = 0; e <script this.elements.length; e++)
                                        t.innerHTML +=
                                        "\n          <span>\n            <span class='thumb-item'></span>\n          </span>\n          ";
                                    this.thumbItems = Array.from(
                                        document.querySelectorAll(".thumb-item")
                                    );
                                }
                            }),
                            (t.prototype.init = function() {
                                this.addControl(), this.addThumbItems(), this.show(this.index);
                            }),
                            t
                        );
                    })(),
                    Timeout = (function() {
                        function t(t, e) {
                            (this.id = setTimeout(t, e)),
                            (this.handler = t),
                            (this.start = Date.now()),
                            (this.timeLeft = e);
                        }
                        return (
                            (t.prototype.clear = function() {
                                clearTimeout(this.id);
                            }),
                            (t.prototype.pause = function() {
                                var t = Date.now() - this.start;
                                (this.timeLeft = this.timeLeft - t), this.clear();
                            }),
                            (t.prototype.continue = function() {
                                this.clear(),
                                    (this.id = setTimeout(this.handler, this.timeLeft)),
                                    (this.start = Date.now());
                            }),
                            t
                        );

                    })(),
                    container = document.getElementById("slide"),
                    elements = document.getElementById("slide-elements"),
                    controls = document.getElementById("slide-controls"),
                    playPause = document.getElementById("play-pause");
                if (
                    container &&
                    elements &&
                    controls &&
                    elements.children.length &&
                    playPause
                )
                    var stories = new Slide(
                        container,
                        Array.from(elements.children),
                        controls,
                        playPause,
                        //  5e3
                    );











            },
            error: function(data) {
                console.log(data.responseJSON.message);

            }

        });
    }










    function showMyStory() {




        $.ajax({
            type: "POST",
            url: "/MyStories",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                //  console.log(data);


                var slide = $('#slide-elements');


                data.stories.forEach(element => {


                    var figure = document.createElement("figure");

                    var a = document.createElement('a');
                    var img = document.createElement('img');
                    var txt1 = document.createElement('p');
                    var txt2 = document.createElement('p');

                    //  figure.appendChild();
                    //  document.getElementbyId('lc').appendChild(element);

                });



            },
            error: function(data) {
                console.log(data.responseJSON.message);
            }
        });

    }
</script>
