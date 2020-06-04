<template>
    <div class="left-sidebar" >
        <div class="chat-header">
            <figure class="avatar">
                <a href="#" class="profile-detail-bttn"><img :src="photo" class="rounded-circle" alt="image" width="50px" height="50px"></a>
            </figure>
            <div style="width: 100%; padding: 8px 10px;">
                <h5 class="mt-0 mb-0" style="color:#fff">{{user.name}}</h5>
                <small class="text-success">{{user.email}}</small> 
            </div> 
        </div>
        <div class="sidebar active" id="chats">
          
            <div class="form-content">
                <form action="#" class="mb-3 mt-3">
                    <input type="text" class="form-control" placeholder="Type name to find contact" v-model="search" @keyup="searchContacts"/>
                </form>
            </div>
            <div class="text-left mb-1 mt-0">
                <div class="chat-header-action nav-content">
                    <ul class="list-inline mb-1 mt-3" style=" margin-left: 0px; ">
                        <li class="list-inline-item mr-3 title-text"><b>Contacts</b> </li>
                        
                        <li class="list-inline-item mr-3 title-text text-right" style="margin-right: 0 !important;padding-right: 5px;padding-left: 0px; "><a title="block user" href="#" style="padding-left: 25px" class="nav-content-bttn" data-tab="settings"><i style="color: #fff;" class="fa fa-eye-slash"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="chat-list-content">
                <ul class="chat-list">
                    <li  v-for="(users,index) in sortedContacts"  class="chat-list-item" >
                        <ul style="padding-left: 0">
                            <li v-for="(contact,index) in users" :key="contact.id" class="chat-list-item" @click="selectContact(contact)" :class="{'selected': contact==selected}">
                                <figure class="avatar user-online" v-if="contact.db==1">
                                    <img v-if="contact.group_id==4" :src="getAvatar(contact.student.photo)" alt="image" width="50px" height="50px">
                                    <img v-else-if="contact.group_id==3" :src="getAvatar(contact.staff.photo)" alt="image" width="50px" height="50px">
                                    <img v-else-if="contact.group_id==5" :src="getAvatar(contact.staff.photo)" alt="image" width="50px" height="50px">
                                    <img v-else-if="contact.group_id==6" :src="getAvatar(contact.committee.photo)" alt="image" width="50px" height="50px">
                                    <img v-else src="" alt="no image" width="50px" height="50px">
                                </figure>
                                <figure class="avatar user-online" v-if="contact.db==2">
                                    <img v-if="contact.group_id==4" :src="getAvatar2(contact.student.photo)" alt="image" width="50px" height="50px">
                                    <img v-else-if="contact.group_id==3" :src="getAvatar2(contact.staff.photo)" alt="image" width="50px" height="50px">
                                    <img v-else-if="contact.group_id==5" :src="getAvatar2(contact.staff.photo)" alt="image" width="50px" height="50px">
                                    <img v-else-if="contact.group_id==6" :src="getAvatar2(contact.committee.photo)" alt="image" width="50px" height="50px">
                                    <img v-else src="" alt="no image" width="50px" height="50px">
                                </figure>
                                <figure class="avatar user-online" v-if="contact.db==3">
                                    <img v-if="contact.group_id==4" :src="getAvatar3(contact.student.photo)" alt="image" width="50px" height="50px">
                                    <img v-else-if="contact.group_id==3" :src="getAvatar3(contact.staff.photo)" alt="image" width="50px" height="50px">
                                    <img v-else-if="contact.group_id==5" :src="getAvatar3(contact.staff.photo)" alt="image" width="50px" height="50px">
                                    <img v-else-if="contact.group_id==6" :src="getAvatar3(contact.committee.photo)" alt="image" width="50px" height="50px">
                                    <img v-else src="" alt="no image" width="50px" height="50px">
                                </figure>
                                <figure class="avatar user-online" v-if="contact.db==4">
                                    <img v-if="contact.group_id==4" :src="getAvatar4(contact.student.photo)" alt="image" width="50px" height="50px">
                                    <img v-else-if="contact.group_id==3" :src="getAvatar4(contact.staff.photo)" alt="image" width="50px" height="50px">
                                    <img v-else-if="contact.group_id==5" :src="getAvatar4(contact.staff.photo)" alt="image" width="50px" height="50px">
                                    <img v-else-if="contact.group_id==6" :src="getAvatar4(contact.committee.photo)" alt="image" width="50px" height="50px">
                                    <img v-else src="" alt="no image" width="50px" height="50px">
                                </figure>
                                <div class="list-body" >
                                    <div class="chat-bttn">
                                        <h3 class="mb-0 mt-2">{{contact.name}}</h3>
                                        <p>{{contact.email}}</p>
                                    </div>
                                    <div class="list-action mt-2 text-right">
                                        <div class="message-count bg-primary" v-if="contact.unread">{{contact.unread}}</div>
                                        <!-- <small class="text-primary">03:41 PM</small> -->
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:{
            contacts:{
                type:Array,
                default:[]
            },
            user:{
                type: Object,
                required: true
            }
        },
        data(){
            return {
                selected:this.contacts.length ? this.contacts[0] : null ,
                search:'',
                photo:''
            }
        },
         mounted () {
             axios.get('/profile/image/')
                    .then((response)=>{
                        this.photo = "/storage/"+response.data;
                    });
            
         },
        methods: {
           selectContact(contact){
                this.selected = contact;
                this.$emit('selected',contact);
            },
            searchContacts(){
                if(this.search.length>=1){
                    axios.get('/contacts/search/'+this.search)
                    .then((response)=>{
                        this.contacts = response.data;
                    });

                }else{
                   this.sortedContacts; 
                }
            },
            getAvatar(avatar){
                return "storage/"+avatar;
            },
            getAvatar2(avatar){
                return "https://en.edubd.app/storage/"+avatar;
            },
            getAvatar3(avatar){
                return "https://madrasah.edubd.app/storage/"+avatar;
            },
            getAvatar4(avatar){
                return "https://technical.edubd.app/"+avatar;
            },
        },
        computed:{
            sortedContacts(){
                return _.sortBy(this.contacts, [(contact) => {
                    if(contact == this.selected){
                        return Infinity;
                    }
                    return contact.unread;
                }]);
            }

        }
    }
</script>
