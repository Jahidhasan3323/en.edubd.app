<template>
    <div class="right-content">
        
            <ContactList :contacts="contacts" @selected="startConvertationWith" :user="user"/>
        <div class="chat-content">
            <!-- chat header -->
                <ChatHead :contact="selectedContact"/>
            <!-- chat header -->
            <!-- chat body -->
                <MessageComponent :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>
            <!-- chat body -->
            <!-- chat footer -->
                
            <!-- chat footer -->
        </div>
    </div>
</template>

<script>
    import ContactList from './ContactList';
    import MessageComponent from './MessageComponent';
    import ChatHead from './ChatHead';
    
    export default {
        props:{
            user:{
                type: Object,
                required: true
            }
        },
        data(){
            
            return {
                selectedContact:null,
                messages:[],
                contacts:[],
                selected:0
            };
        },
        mounted() {
            Echo.private(`chattings`)
             .listen('NewMessage',(e) => {
                this.handelIncoming(e.chatting);
             })

            axios.get('/contacts')
            .then((response)=>{
                this.contacts = response.data;
            });
        },
        methods:{
            
            startConvertationWith(contact){
                this.updateUnreadCount(contact, true);
                axios.get(`/convertation/${contact.id}`)
                .then((response)=>{
                    this.messages=response.data;
                    this.selectedContact=contact;
                })
            },
            
            saveNewMessage(text){
                this.messages.push(text);
            },
            handelIncoming(chatting){
                if(this.selectedContact && chatting.from == this.selectedContact.id){
                   this.saveNewMessage(chatting);
                   return;
                }
                this.updateUnreadCount(chatting.from_contact, false);
            },
            updateUnreadCount(contact, reset){
                this.contacts = this.contacts.map((single) => {
                    if(single.id != contact.id){
                        return single;
                    }

                    if(reset)
                        single.unread=0;
                    else 
                        single.unread+=1;

                    return single;
                })
            }


        },
        components: {ContactList,MessageComponent,ChatHead}
    }
</script>
