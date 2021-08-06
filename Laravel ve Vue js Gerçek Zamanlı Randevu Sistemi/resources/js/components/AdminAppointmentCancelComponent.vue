<template>
    <div class="container">

        <appointment-item :data ="items.data" ></appointment-item>


        <div class="row" style="margin-top: 10px">
            <div class="col-md-12">
                <pagination :data="items" @pagination-change-page="getData"></pagination>
            </div>
        </div>
    </div>

</template>

<script>

export default
{
    data(){
        return{
            items:{
                data:[]
            }
        }
    },
    created(){
        this.getData();
    },
    mounted() {
        console.log('call me..');
    },
    methods:{
        getData(page){
            if(typeof page == 'undefined')
            {
                page=1;
            }
            console.log('gubün');
            axios.get('http://127.0.0.1:8000/api/admin/cancel-list/?page=${page}')
                .then(res=> {
                    this.items = res.data;
                });
        }
    }
}



</script>
