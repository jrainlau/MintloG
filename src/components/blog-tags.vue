<template>
    <div id="blog-tags">
        <template v-for="i in tags.length">
            <a href="#" v-link="{path:'/search/tag/' + tags[i]}">
                {{tags[i]}}
            </a>
        </template>
    </div>
</template>

<script>
    export default {
        props: ['artlist'],
        computed: {
            tags: function () {
                var arr = this.artlist
                var hash = {}
                var newArr = []
                for(var i = 0; i < arr.length; i++) {
                    if(!hash[arr[i].tag]) {
                        hash[arr[i].tag] = true
                        newArr.push(arr[i].tag)
                    }
                }
                return newArr
            }
        },
        ready: function () {}
    }
</script>

<style lang=less>
    #blog-tags {
        box-sizing: border-box;
        width: 100%;
        padding: 15px;
        margin-bottom: 30px;
        background: #fff;
        box-shadow: 8px 8px 12px #888888;
        a {
            color: #5ce4bc;
            padding: 0 15px;
            &:hover {
                color: #4dbc9b;
            }
        }
    }
</style>