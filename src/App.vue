<template>
  <div id="app">
    <nav class="blog-head">
      <blog-head>head</blog-head>
    </nav>

    <main>
      <router-view></router-view> 
    </main>
  </div>
  <canvas id='canvas' width=1800 height=1800>unsupport</canvas>
</template>

<script>
 import blogHead from './components/blog-head.vue'
 import writePanel from './components/write-panel.vue'

function background() {
  var canvas = document.getElementById('canvas')
  var ctx = canvas.getContext('2d')
  ctx.strokeStyle = "rgba(92, 228, 188, 1)"
  ctx.fillStyle = "rgba(92, 228, 188, 1)"
  ctx.lineWidth = 4
  for (var i = 0; i < 120; i++) {
    drawRound()
  }
  function drawRound() {
    var x = parseInt(1800*Math.random()),
        y = parseInt(1800*Math.random()),
        r = parseInt(50*Math.random());
    ctx.beginPath()
    ctx.arc(x, y, r, 0, 2*Math.PI,true)
    ctx.fill()
    ctx.stroke()
  }
}

export default {
  data: function () {
    return {
      artList: [],
      editMode: 'off'
    }
  },
  ready: function () {
    background()
  },
  components: {
    blogHead
  }
}
</script>

<style lang=less>
  * {
    margin: 0;
    padding: 0;
    font-family: "microsoft yahei";
    &::-webkit-scrollbar {
      width: 5px;
      background: transparent;
    }
    &::-webkit-scrollbar-thumb {
      background: #4dbc9b;
    }
  }
  body {
    overflow: hidden;
  }
  #app {
    width: 100%;
    .blog-head {
      width: 100%;
    }
    main {
      height: 600px;
      overflow-y: scroll;
      .blog-content {
        box-sizing: border-box;
        float: left;
        padding: 30px 45px;
        width: 70%;
      }
      .blog-side {
        box-sizing: border-box;
        float: left;
        padding: 30px 45px;
        width: 30%;
      }
    }
  }
  #canvas{
    position: fixed;
    top: 0;
    left: 0;
    z-index: -1;
  }
</style>
