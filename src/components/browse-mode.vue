<template>
    <div id="browse-mode-viewer">
        <div class="blog-content">
            <router-view :artlist="artList"></router-view>
        </div>
        <section class="blog-side">
            <blog-search></blog-search>
            <blog-tags :artlist="filters">side1</blog-tags>
            <blog-timeline :artlist="filters">side2</blog-timeline>
        </section>
    </div>
</template>

<script>
    import blogSearch from './blog-search.vue'
    import blogTags from './blog-tags.vue'
    import blogTimeline from './blog-timeline.vue'

    export default {
        data: function () {
            return {
                artList: [],
                filters: []
            }
        },
        http: {
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        },
        route: {
            data: function () {
                var theRoute = this.$route.params
                if (!theRoute.tag && !theRoute.time && !theRoute.title) {
                    this.$emit('getList')
                } else if (theRoute.tag) {
                    this.filtBy(theRoute.tag, '5')
                } else if (theRoute.time) {
                    this.filtBy(theRoute.time, '6')
                } else if (theRoute.title) {
                    this.filtBy(theRoute.title, '7')
                }
            }
        },
        components: {
            blogTags,
            blogTimeline,
            blogSearch
        },
        methods: {
            filtBy: function (keyword, subType) {
                var self = this
                self.$http.post('http://localhost/ago_blog/options.php', {subType: subType, artTag: keyword}).then(function (response) {
                    if (response.data.length != 0) {
                        self.artList = response.data
                    } else {
                        swal('搜索结果为空', '请输入其它标题关键字', 'error')
                    }
                }, function (response) {
                    console.log('error')
                })
            }
        },
        events: {
            getList: function () {
                var self = this
                this.$http({url: 'http://localhost/ago_blog/options.php', method: 'POST'}).then(function (response) {
                    self.artList = response.data
                    self.filters = response.data
                }, function (response) {
                    swal("ERROR!", "", "error")
                })
            },
            'refresh': function () {
                this.$emit('getList')
            }
        }
    }
</script>