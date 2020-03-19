<template>
    <div class="chat-footer">
        <form action="#">
            <textarea v-model="message" @keydown.enter="send" placeholder="Write message Here ..."></textarea> 
            <button v-on:click="send"><i class="glyphicon glyphicon-send"></i></button>
        </form>
    </div>
</template>
 
<script>
    export default {
        data(){
            return {
                message: ""
            };
        },
        methods:{
            send(e){
                e.preventDefault();
                if(this.message == ''){
                    return;
                }
                this.$emit('send',this.message);
                this.message = '';
            }
        }
    }
</script>
