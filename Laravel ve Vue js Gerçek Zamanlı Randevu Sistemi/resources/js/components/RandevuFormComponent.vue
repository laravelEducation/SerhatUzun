<template>
    <div>
    <div v-if="completeForm">

            <div class="container">

                <div  class="row">
                    <div class="col-md-12">
                        <ul>
                            <li class =" errors"v-for="i in errors">
                            {{i}}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" v-model="name" class="form-control" placeholder="Ad Soyad">

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" v-model="email"  class="form-control" placeholder="Email">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text"  v-mask="'###-###-##-##'" v-model="phone"  class="form-control" placeholder="Telefon">

                            </div>
                        </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input v-model="date" @change="selectDate" class="form-control" type="date">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="select-time-ul">
                            <li v-for="item in workingHours" class="select-time">
                                <input v-if="item.isActive" type="radio" v-model="workingHour" v-bind:value="item.id">
                                <span> {{ item.hours }}</span>
                            </li>


                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea v-model="text" class="form-control" id="" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Sms</label>
                                        <input type="radio" v-model="notification_type" value="0">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="radio" v-model="notification_type" value="1">
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button v-on:click="store"  class="btn btn-success">Randevu Oluştur</button>
                    </div>
                </div>
            </div>
    </div >
        <div v-if="!completeForm">
            <div class="complete-form">
                <i class="fas fa-check-circle"></i>
                <span>Randevunuz Başarı İle Alınmıştır</span>
            </div>
        </div>
    </div>



</template>
<script>

    export default
    {
        data(){
          return {
              completeForm : true,
              errors:[],
              notification_type:null,
              workingHour:0 ,
              name:null,
              email:null,
              phone:null,
              text:null,
              date:new Date().toISOString().slice(0,10),
              workingHours:[]

          }
        },
        mounted() {
            axios.get('http://127.0.0.1:8000/api/working-hours')
            .then((res)=>{
                this.workingHours = res.data;
            })


        },
        methods: {
            store: function () {
                if (this.notification_type && this.name && this.email && this.validEmail(this.email) && this.phone && this.workingHour != 0) {
                    axios.post('http://127.0.0.1:8000/api/appointment-store',{

                        fullName:this.name,
                        phone:this.phone,
                        email:this.email,
                        date:this.date,
                        workingHour:this.workingHour,
                        notification_type :this.notification_type
                    }).then((res)=>{
                       if(res.status)
                       {
                           this.completeForm = false;
                       }
                    })

                }
                this.errors = [];

                if(!this.notification_type){
                    this.errors.push('Bilgirim Tipini Seçiniz')
                }

                if (!this.name) {
                    this.errors.push('İsim ve Soyisminizi Giriniz')
                }
                if (!this.email || !this.validEmail(this.email)) {
                    this.errors.push('Email Adresinizi Giriniz')
                }
                if (!this.phone) {
                    this.errors.push('Telefon Numaranızı Giriniz')
                }
                if (!this.workingHour) {
                    this.errors.push('Çalışma Saati Seçiniz')
                }


                console.log("tıklandı");
            },
            selectDate: function () {
                axios.get('http://127.0.0.1:8000/api/working-hours/${this.date}')
                    .then((res) => {
                        this.workingHours = res.data;
                    })

            },
            validEmail: function (email) {
                var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            }
        }

    }



</script>
