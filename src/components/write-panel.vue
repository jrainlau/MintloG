<template>
  <div id="write-panel">
    <toolbox></toolbox>
    <div class="write-panel-area">
      <section class="input-area">
        <input type="text" v-model='title' placeholder="文章标题...">
        <input type="text" v-model='tag' placeholder="文章标签...">
        <textarea autofocus id="inputter" v-model="article" placeholder="文章内容..."></textarea>
      </section>
      <output id="outputter" class="output" v-html="article | markify"></output>
    </div>
    <div class="pull-left">
      <button @click='save'>本地缓存</button>
      <button @click='read'>加载上次</button>
    </div>

    <div class="pull-right">
      <button class="cancel" @click='cancel'>取消</button>
      <button @click="submit">提交</button>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import marked from '../../lib/marked'
import toolbox from './toolbox.vue'

Vue.filter('markify', function (val) {
  return marked(val)
})

export default {
  data: function () {
    return {
      title: '',
      tag: '',
      article: '',
      artId: '',
      editMode: 'new'
    }
  },
  components: {
    toolbox
  },
  http: {
    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
  },
  route: {
    data: function () {
      var self = this
      this.editMode = this.$route.params.mode
      if (this.editMode != 'new') {
        self.$http.post('http://localhost/ago_blog/options.php', {subType: "4", artId: self.editMode}).then(function (response) {
            var artInfo = response.data
            self.title = artInfo[0].title
            self.tag = artInfo[0].tag
            self.article = artInfo[0].content
            self.artId = artInfo[0].id
        }, function (response) {
            console.log('error')
        })
      } else if (this.editMode == 'new') {
            self.title = ''
            self.tag = ''
            self.article = ''
      }
    }
  },
  methods: {
    save: function () {
      localStorage.article = this.article
      swal('本地缓存成功', '请勿清空浏览器信息', 'success')
    },
    read: function () {
      this.article = localStorage.article
    },
    cancel: function () {
      location.href = '#!/'
    },
    submit: function () {
      var self = this
      var subType = '1'
      if (self.editMode == 'new') {
        subType = '1'
        var alertWord = '提交成功！'
      } else {
        subType = '2'
        var alertWord = '修改成功！'
      }
      function markedArt () {
        return marked(self.article)
      }
      self.$http.post('http://localhost/ago_blog/options.php', {
        subType: subType,
        artTitle: self.title,
        artTag: self.tag,
        artContent: markedArt(),
        artId: self.artId
      }).then(function (response) {
          if(response.data == 1) {
            swal(
              {
                title: alertWord,
                text: "",
                type: "success",
                showCancelButton: false,
                closeOnConfirm: true
              },
              function(){
                location.href = '#!/'
              });
          }
      }, function (response) {
          console.log('error')
      })
    }
  }
}
</script>

<style lang=less>
  #write-panel {
    padding: 15px 45px;
    .write-panel-area {
      width: 100%;
      height: 450px;
      margin-bottom: 15px;
      .input-area {
        float: left;
        width: 49%;
        height: 100%;
        resize: none;
        input {
          box-sizing: border-box;
          display: block;
          width: 100%;
          height: 30px;
          margin-bottom: 15px;
          padding: 0 15px;
          border: 2px solid #5ce4bc;
          box-shadow: 5px 5px 12px #888888;
          &:focus {
            outline: none;
            border-color: #4dbc9b;
          }
        }
        textarea {
          box-sizing: border-box;
          width: 100%;
          height: 360px;
          padding: 15px;
          border: 2px solid #5ce4bc;
          box-shadow: 5px 5px 12px #888888;
          resize: none;
          &:focus {
            outline: none;
            border-color: #4dbc9b;
          }
        }
      }
      .output {
        box-sizing: border-box;
        float: right;
        padding: 15px;
        width: 49%;
        height: 100%;
        overflow-x: hidden;
        overflow-y: scroll;
        background: #4dbc9b;
        color: #fff;
        box-shadow: 5px 5px 12px #888888;
      }
    }
    .pull-left {
      float: left;
        button {
        margin-right: 15px;
        margin-bottom: 5px;
        width: 5%;
        min-width: 60px;
        height: 30px;
        border: none;
        background: #5ce4bc;
        color: #fff;
        box-shadow: 5px 5px 12px #888888;
        &:hover {
          background: #4dbc9b;
        }
        &:active {
          outline: none;
          box-shadow: 5px 5px 8px #888888;
        }
        &:focus {
          outline: none;
        }
      }
    }
    .pull-right {
      .pull-left;
      float: right;
      button {
        margin-right: 0;
        margin-left: 15px;
        &.cancel {
          background: #fff;
          color: #4dbc9b;
          &:active {
            outline: none;
            box-shadow: 5px 5px 8px #888888;
          }

        }
      }
    }
  }
</style>
