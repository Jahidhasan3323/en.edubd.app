<template>
    <div class="chat-header">
        <div class="chat-header-user">
            <figure class="avatar" v-if="contact.db==1">
                <img v-if="contact.group_id==4" :src="contact ? 'storage/'+contact.student.photo : ' '" class="rounded-circle" alt="image" width="50px" height="50px">
                <img v-else-if="contact.group_id==3" :src="contact ? 'storage/'+contact.staff.photo : ' '" class="rounded-circle" alt="image" width="50px" height="50px">
                <img v-else-if="contact.group_id==5" :src="contact ? 'storage/'+contact.staff.photo : ' '" class="rounded-circle" alt="image" width="50px" height="50px">
                <img v-else-if="contact.group_id==6" :src="contact ? 'storage/'+contact.committee.photo : ' '" class="rounded-circle" alt="image" width="50px" height="50px">
                <img v-else src="" alt="no image" width="50px" height="50px" class="rounded-circle">
            </figure>
            <figure class="avatar" v-if="contact.db==2">
                <img v-if="contact.group_id==4" :src="contact ? 'https://en.edubd.app/storage/'+contact.student.photo : ' '" class="rounded-circle" alt="image" width="50px" height="50px">
                <img v-else-if="contact.group_id==3" :src="contact ? 'https://en.edubd.app/storage/'+contact.staff.photo : ' '" class="rounded-circle" alt="image" width="50px" height="50px">
                <img v-else-if="contact.group_id==5" :src="contact ? 'https://en.edubd.app/storage/'+contact.staff.photo : ' '" class="rounded-circle" alt="image" width="50px" height="50px">
                <img v-else-if="contact.group_id==6" :src="contact ? 'https://en.edubd.app/storage/'+contact.committee.photo : ' '" class="rounded-circle" alt="image" width="50px" height="50px">
                <img v-else src="" alt="no image" width="50px" height="50px" class="rounded-circle">
            </figure>
            <figure class="avatar" v-if="contact.db==3">
                <img v-if="contact.group_id==4" :src="contact ? 'https://madrasah.edubd.app/storage/'+contact.student.photo : ' '" class="rounded-circle" alt="image" width="50px" height="50px">
                <img v-else-if="contact.group_id==3" :src="contact ? 'https://madrasah.edubd.app/storage/'+contact.staff.photo : ' '" class="rounded-circle" alt="image" width="50px" height="50px">
                <img v-else-if="contact.group_id==5" :src="contact ? 'https://madrasah.edubd.app/storage/'+contact.staff.photo : ' '" class="rounded-circle" alt="image" width="50px" height="50px">
                <img v-else-if="contact.group_id==6" :src="contact ? 'https://madrasah.edubd.app/storage/'+contact.committee.photo : ' '" class="rounded-circle" alt="image" width="50px" height="50px">
                <img v-else src="" alt="no image" width="50px" height="50px" class="rounded-circle">
            </figure>
            <figure class="avatar" v-if="contact.db==4">
                <img v-if="contact.group_id==4" :src="contact ? 'https://technical.edubd.app/'+contact.student.photo : ' '" class="rounded-circle" alt="image" width="50px" height="50px">
                <img v-else-if="contact.group_id==3" :src="contact ? 'https://technical.edubd.app/'+contact.staff.photo : ' '" class="rounded-circle" alt="image" width="50px" height="50px">
                <img v-else-if="contact.group_id==5" :src="contact ? 'https://technical.edubd.app/'+contact.staff.photo : ' '" class="rounded-circle" alt="image" width="50px" height="50px">
                <img v-else-if="contact.group_id==6" :src="contact ? 'https://technical.edubd.app/'+contact.committee.photo : ' '" class="rounded-circle" alt="image" width="50px" height="50px">
                <img v-else src="" alt="no image" width="50px" height="50px" class="rounded-circle">
            </figure>
            <div>
                <h5 class="mt-2 mb-0" style="color:#fff">{{contact ? contact.name : 'Select a contact'}}</h5>
                <small class="text-success">{{contact ? contact.email : ' '}}</small>
            </div>
        </div>
        <div class="chat-header-action">
            <ul class="list-inline mb-0 mt-2"> 
                <!-- <li class="list-inline-item not-mobile"><a href="#" class="bttn-box-round"><i class="ti-microphone"></i></a></li>
                <li class="list-inline-item not-mobile"><a href="#" class="bttn-box-round" id="videocall-bttn"><i class="ti-video-camera"></i></a></li> -->
                <!-- <li class="list-inline-item d-xl-none d-lg-none"><a href="#" class="bttn-box-round back-chat-div"><i class="ti-arrow-left"></i></a></li> -->
                <li class="list-inline-item">
                    <a href="#" class="bttn-box-round" data-toggle="dropdown"><i class="fa fa-cog"></i></a>
                    <div class="dropdown-menu dropdown-menu-right ">
                        <a href="#" class="dropdown-item profile-detail-bttn">Profile</a>
                        <a href="#" class="dropdown-item">Add to archived</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item text-danger">Block</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props:{
            contact:{
                type:Object,
                default:null
            }
            
        },
        mounted() {
        }
    }
</script>
