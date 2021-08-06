<template>
    <div class="row">
            <div v-for="item in data" class="col-md-4" >
                <div class="card appointment-card">

                    <span class="appointment-number">Randevu

                    <span class="new-appointment" v-if="!item.isActive"> Yeni </span>
                    </span>
                    <div class="appointment-detail">
                        <span>{{item.fullName}}</span>
                        <span>{{item.date}}</span>
                        <span>{{item.working}}</span>
                    </div>
                    <div v-if="!item.isActive">
                        <button @click="appointmentOkey(item.id)"> Onayla</button>
                        <button @click="appointmentCancel(item.id)"> İptal Et</button>
                    </div>
                </div>
            </div>
    </div>

</template>

<script>

export default
{
    props:['data'],
    created(){
        console.log
    },
    methods:{
        appointmentOkey:function (id){
            axios.post('http://127.0.0.1:8000/api/admin/process',{
                type:1,
                id:id
            })
            .then((res)=>{
                console.log(res);
            })

        },
        appointmentCancel:function (id){
            axios.post('http://127.0.0.1:8000/api/admin/process',{
                type:2,
                id:id
            })
                .then((res)=>{
                    console.log(res);
                })

        }
    }
}



</script>
