<template>
    <div id="blog-timeline">
        <template v-for="i in timeline.length">
            <a href="#" v-link="{path:'/search/time/' + timeline[i]}">
                {{timeline[i]}}
            </a>
        </template>
    </div>
</template>

<script>
    export default {
        props: ['artlist'],
        computed: {
            timeline: function () {
                var arr = this.artlist
                var hash = {}
                var newArr = []
                for(var i = 0; i < arr.length; i++) {
                    if(!hash[arr[i].time]) {
                        hash[arr[i].time] = true
                        newArr.push(arr[i].time)
                    }
                }
                return newArr
            }
        },
    }
</script>

<style lang=less>
    #blog-timeline {
        box-sizing: border-box;
        width: 100%;
        padding: 15px;
        margin-bottom: 30px;
        box-shadow: 8px 8px 12px #888888;
        background: #fff;
        a {
            display: block;
            color: #5ce4bc;
            padding: 0 15px;
            margin-bottom: 15px;
            &:hover {
                color: #4dbc9b;
            }
        }
    }
</style>