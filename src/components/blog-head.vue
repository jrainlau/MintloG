<template>
    <div id="blog-head">
        <a id='b-logo' class="b-logo" v-link="{ path: '/' }">
            <i class="fa fa-home"></i>
        </a>
        <img src="../../image/MintloG-logo.png" alt="">
        <a id="b-head" v-link="{ path: '/edit/new' }">
            <i class="fa fa-pencil-square-o"></i>
        </a>
    </div>
</template>

<script>
    
</script>

<style lang=less>
    #blog-head {
        box-sizing: border-box;
        width: 100%;
        height: 40px;
        padding: 5px 46px;
        background: #5ce4bc;
        display: flex;
        align-items: center;
        justify-content: space-between;
        img {
            width: 35px;
            height: 35px;
        }
        a {
            display: inline-block;
            text-decoration: none;
            &.b-logo {
                i {
                    font-size: 28px;
                    color: #fff;
                }
            }
            &#b-head {
                i {
                    font-size: 28px;
                    color: #fff;
                }
            }
        }
    }
</style>