<template>
    <div id="blog-article">
        <div class="art-info">
            <h3>{{artInfo[0].title}}</h3>
            <span>{{artInfo[0].time}}</span>
            <span>
                <a href="">{{artInfo[0].tag}}</a>
            </span>
        </div>
        <p v-html="artInfo[0].content">
            
        </p>
        <div class="option-box">
            <a class="del-btn" href="#" v-link="{path:'/edit/' + artInfo[0].id}">编辑</a>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                artInfo: {}
            }
        },
        http: {
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        },
        route: {
            data: function () {
                var artId = this.$route.params.artId
                var self = this
                self.$http.post('http://localhost/ago_blog/options.php', {subType: "4", artId: artId}).then(function (response) {
                    self.artInfo = response.data
                }, function (response) {
                    console.log('error')
                })
            }
        }
    }
</script>

<style lang=less>
    #blog-article {
        padding: 15px;
        width: 100%;
        background: #5ce4bc;
        box-shadow: 8px 8px 12px #888888;
        .art-info {
            width: 100%;
            margin-bottom: 15px;
            h3, span {
                display: inline-block;
                width: 32%;
            }
            span {
                text-align: center;
                a {
                    color: #000;
                }
            }
        }
        .option-box {
            text-align: right;
            .del-btn {
                color: #fff;
                text-decoration: none;
                &:focus {
                    outline: none;
                }
            }
        }
    }
</style>