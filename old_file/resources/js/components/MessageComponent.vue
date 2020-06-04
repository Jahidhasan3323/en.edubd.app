<template>
    <div class="chat-body"  >
        <div class="messages-content chat-app" style="overflow: scroll;outline: none; height: 300px" ref="feed" v-if="contact">

            <div  v-for="message in messages" :class="`message-item ${message.to == contact.id ? 'outgoing-message' : ' ' }`" :key="message.id">
                <div v-if="message.to == contact.id" class="message-user">
                    <div class="message-wrap" style="padding: 0 10px; text-align: left; margin-right: 5px;">{{message.messasge}}</div>
                    <figure class="avatar">
                        <img :src="photo" alt="image" width="50px" height="50px">
                    </figure>
                    <div>
                        <!-- <h5>Byrom Guittet</h5> -->
                        <!-- <div class="time">{{message.messasge}}</div>  -->
                    </div>
                
                </div>
                <div v-else class="message-user">
                
                    <figure class="avatar" style="margin-right: -15px;" v-if='contact.db==1'>
                        <img :src="contact ? 'storage/'+contact.student.photo : ' '" alt="image" width="50px" height="50px">
                    </figure>
                    <figure class="avatar" style="margin-right: -15px;" v-if='contact.db==2'>
                        <img :src="contact ? 'https://en.edubd.app/storage/'+contact.student.photo : ' '" alt="image" width="50px" height="50px">
                    </figure>
                    <figure class="avatar" style="margin-right: -15px;" v-if='contact.db==3'>
                        <img :src="contact ? 'https://madrasah.edubd.app/storage/'+contact.student.photo : ' '" alt="image" width="50px" height="50px">
                    </figure>
                    <figure class="avatar" style="margin-right: -15px;" v-if='contact.db==4'>
                        <img :src="contact ? 'https://technical.edubd.app/'+contact.student.photo : ' '" alt="image" width="50px" height="50px">
                    </figure>
                    <div>
                        <!-- <h5>Byrom Guittet</h5> -->
                        <!-- <div class="time">{{message.messasge}}</div>  -->
                    </div>
                    <div class="message-wrap" style="padding: 0 10px; text-align: left; margin-right: 5px;">{{message.messasge}}</div>
                </div>

            </div>

            
        </div>
    <ChatFooter @send="sendMessage" />
    </div>
</template>

<script>
    import ChatFooter from './ChatFooter';
    export default {
        props:{
            contact:{
                type:Object,
                default:null
            },
            messages:{
                type:Array,
                default:[]
            }
        },
        data(){
            return {
                photo:''
            }
        },
        mounted () {
             axios.get('/profile/image/')
                    .then((response)=>{
                        this.photo = "/storage/"+response.data;
                    });
            
         },
        methods:{
            sendMessage(text){
                if(!this.contact){
                    this.$fire({
                      title: "Warning",
                      text: "Please Select a contact",
                      type: "warning",
                    }).then(r => {
                     console.log(r.value);
                    });
                    return;
                }

                axios.post('/message/send',{
                    contact_id:this.contact.id,
                    to_db:this.contact.db,
                    text:text
                }).then((response) => {
                    this.$emit('new', response.data);
                })
            },
             scrollToBottom(){
                setTimeout(()=>{
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                }, 50);
             }
        }, 
        watch:{
            contact(contact){
                this.scrollToBottom();
            },
            messages(messages){
                this.scrollToBottom();
            } 
        },
         components: {ChatFooter}
    }
</script>
