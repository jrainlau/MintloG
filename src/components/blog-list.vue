<template>
    <div id="blog-list">
        <ul>
            <li v-for="i in artlist.length">
                <div class="art-info">
                    <h3>
                        <a v-link="{ path: '/details/'+artlist[i].id }">{{artlist[i].title}}</a>
                    </h3>
                    <span>
                        <a href="#" v-link="{path:'/search/time/' + artlist[i].time}">
                            {{artlist[i].time}}
                        </a>
                    </span>
                    <span>
                        <a href="#" v-link="{path:'/search/tag/' + artlist[i].tag}">
                            {{artlist[i].tag}}
                        </a>
                    </span>
                </div>
                <p v-html="artlist[i].content"></p>
                <div class="option-box">
                    <a class="del-btn" href="javascript:void(0)" @click="deleteIt(artlist[i].id)">删除</a>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ['artlist'],
        http: {
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        },
        methods: {
            deleteIt: function (id) {
                var self = this
                self.$http.post('http://localhost/ago_blog/options.php', {
                  subType: "3",
                  artId: id
                }).then(function (response) {
                    if(response.data == 1) {
                      swal(
                        {
                          title: "删除成功！",
                          text: "",
                          type: "success",
                          showCancelButton: false,
                          closeOnConfirm: true
                        },
                        function () {
                          self.$dispatch('refresh', 'refresh')
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
    #blog-list {
        width: 100%;
        ul {
            box-sizing: border-box;
            list-style: none;
            li {
                box-sizing: border-box;
                margin-bottom: 30px;
                padding: 15px;
                background: #fff;
                box-shadow: 8px 8px 12px #888888;
                .art-info {
                    h3 {
                        display: inline-block;
                        width: 32%;
                        a {
                            text-decoration: none;
                            color: #5ce4bc;
                            &:hover {
                                color: #4dbc9b;
                            }
                        }
                    }
                    span {
                        display: inline-block;
                        width: 32%;
                        text-align: center;
                        color: #5ce4bc;
                        a {
                            text-decoration: none;
                            color: #5ce4bc; 
                            &:hover {
                                color: #4dbc9b;
                            }
                        }
                        &:last-child {
                            text-align: right;
                        }
                    }
                }
                p {
                    padding-top: 15px;
                    max-height: 81px;
                    overflow: hidden;
                }
                .option-box {
                    text-align: right;
                    .del-btn {
                        color: #aaa;
                        font-size: 8px;
                        text-decoration: none;
                        &:focus {
                            outline: none;
                        }
                    }
                }
            }
        }
    }
</style>