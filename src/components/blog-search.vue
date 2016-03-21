<template>
    <div id="blog-search">
        <input type="text" v-model='keyword' @keyup.enter='search' placeholder="请输入文章题目">
    </div>
</template>

<script>
    export default {
        data: function () {
            keyword: ''
        },
        methods: {
            search: function () {
                if (this.keyword) {
                    location.href = '#!/search/title/' + this.keyword
                    this.keyword = ''
                } else {
                    swal('标题关键字不能为空', '请输入标题关键字', 'warning')
                }
            }
        }
    }
</script>

<style lang=less>
    #blog-search {
        box-sizing: border-box;
        position: relative;
        height: 35px;
        margin: 0 0 30px 0;
        box-shadow: 8px 8px 12px #888888;
        input {
            box-sizing: border-box;
            padding: 0 15px 0 35px;
            width: 100%;
            height: 100%;
            border: none;
            outline: none;
            font-size: 12px;
            &:focus {
                border: 2px solid #4dbc9b;
            }
        }
        &:after {
            content: "";
            position: absolute;
            top: 10px;
            left: 10px;
            display: inline-block;
            width: 10px;
            height: 10px;
            border: 2px solid #5ce4bc;
            border-radius: 15px;
        }
        &:before {
            content: "";
            position: absolute;
            top: 20px;
            left: 22px;
            height: 4px;
            border: 1px solid #5ce4bc;
            transform: rotate(130deg);
        }
    }
</style>