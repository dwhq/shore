<template>
    <div class="row">
        <div class="col-sm-6">
            <img :src="url+'&time='+time" @click="switchImg">
        </div>
        <div class="col-sm-6">
            <input type="text" name="verify" v-model="captcha" class="form-control" placeholder="请输入验证码">
        </div>
    </div>
</template>
<script>
    export default {
        components: {
        },
        props:{
            //请求数据地址
            url:{
                type:[String],
                default: function () {
                    return '';
                }
            },
            //绑定值
            value: {
                type:[Boolean,String],
                default: function () {
                    return '';
                }
            }, //默认选项
            data:{
                type: [Object,Array],
                default: function () {
                    return {
                    };
                }
            }
        },
        data(){
            return {
                time:Date.parse(new Date()),
                captcha:this.value
            }
        },
        methods:{
            switchImg(){
                this.time = Date.parse(new Date());
                this.captcha = '';
            }
        },
        watch:{
            value(value,oldValue){
                if(this.captcha!=value){
                    this.captcha = value;
                    this.time = Date.parse(new Date());
                }
            },
            captcha(value,oldValue){
                this.$emit('input', value); //修改值
                this.$emit('change',value); //修改值
            }
        },
        mounted() {

        }
    }
</script>
