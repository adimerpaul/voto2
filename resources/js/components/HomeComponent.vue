<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Electores
                <small>Controlar</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Sistema de votacion</a></li>
                <li><a href="#">Electores</a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h2 class="page-header">
                                <i class="fa fa-globe"></i> Listado de electores
                            </h2>
                            <button class="btn btn-default" @click.prevent="modal">Importar</button>
                            <button class="btn btn-default" @click.prevent="test">Resetear</button>
                            <button class="btn btn-default" @click.prevent="finish">Imprimir</button>
                            <small class="pull-right">
                                <button class="btn btn-primary"> <i class="fa fa-user"></i> Agregar nuevo</button>
                            </small>
                        </div>
                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Importacion de datos</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Seleccione el archivo excel a importar,esta opcion reeplaza todos los registros existentes y por los nuevos datos</p>
                                        <input type="file" id="file" ref="file" @change="handleFileUpload()" accept=".XLSX, .CSV" class="form-control">
<!--                                        <table v-if="parse_csv" border="1">-->
<!--                                            <tr v-for="csv in parse_csv">-->
<!--                                                <td v-for="key in parse_header">-->
<!--                                                    {{csv[key]}}-->
<!--                                                </td>-->
<!--                                            </tr>-->
<!--                                        </table>-->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" v-on:click="EventSubir()">Importar datos</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table1 table1-bordered" border="1"  width="100%">
                                <tr class="bg bg-primary" >
                                    <th>N°</th>
                                    <th>CI</th>
                                    <th>Nombres</th>
                                    <th>Mesa</th>
                                    <th>Votacion</th>
                                    <th>Opciones</th>
                                </tr>
                                <tr v-if="electores.length!=0">
                                    <td>si{{electores.length}}</td>
                                </tr>
                                <tr v-else >
                                    <td COLSPAN="6" style="text-align: center">Sin valores en la tabla</td>
                                </tr>
<!--                                <tr>-->
<!--                                    <td>N°</td>-->
<!--                                    <td>CI</td>-->
<!--                                    <td>Nombres</td>-->
<!--                                    <td>Mesa</td>-->
<!--                                    <td>Votacion</td>-->
<!--                                </tr>-->
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
</template>
<script>
    export default {
        data(){
          return{
              electores:[],
              file: '',
              parse_header: [],
              parse_csv: [],
          }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            modal(){
                $('#modal-default').modal('show');
                // console.log('aa');
                // import('@/vendor/Export2Excel').then(excel => {
                    // const tHeader = ['Id', 'Title', 'Author', 'Readings', 'Date']
                    // const data = this.list
                    // excel.export_json_to_excel({
                    //     header: tHeader, //Se requiere encabezado
                    //     data, //Datos específicos requeridos
                    //     filename: 'excel-list', //Opcional
                    //     autoWidth: true, //Opcional
                    //     bookType: 'xlsx' //Opcional
                    // })
                // })
            },
            activate(){
                this.$loading(true);
            },
            async EventSubir(){
                // this.$loading(true);
                let formData = new FormData();
                formData.append('file', this.file);
                axios.post( '/import-excel-personas', formData,{
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        },
                    onUploadProgress (e) {
                            let progress = Math.round((e.loaded * 100.0) / e.total);
                            console.log(progress);
                        }
                }).then(function(){
                        console.log('SUCCESS!!');
                        // this.$loading(false);
                    })
                    .catch(function(){
                        console.log('FAILURE!!');
                        // this.$loading(false);
                    });
                // this.$Progress.start()
                // await this.parse_csv.forEach(async (res)=>{
                //     // console.log(res);
                //     await axios.post('/users',res).then(async (res)=>{
                //         await console.log(res);
                //     })
                // })
                // this.$Progress.finish()}
                // this.$Progress.start()
                // let formData= new FormData();
                // formData.append('data',JSON.stringify(this.parse_csv));
                // axios.post('/users',formData).then(res=>{
                //     console.log(res);
                //     this.$Progress.finish()
                // }).catch(error=>{
                //     console.log(error)
                //     this.$Progress.fail()
                // })
            },
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            },
            start () {
                this.$Progress.start()
            },
            set (num) {
                this.$Progress.set(num)
            },
            increase (num) {
                this.$Progress.increase(num)
            },
            decrease (num) {
                this.$Progress.decrease(num)
            },
            finish () {
                this.$Progress.finish()
            },
            fail () {
                this.$Progress.fail()
            },
            test(){
                // this.$Progress.start()
                // axios.get('http://api.rottentomatoes.com/api/public/v1.0/lists/movies/in_theaters.json?apikey=7waqfqbprs7pajbz28mqf6vz')
                //     .then((response) => {
                //         this.$Progress.finish()
                //     }, (response) => {
                //         this.$Progress.fail()
                //     })
                this.$Progress.start()
                axios.get('/users').then(res=>{
                    this.$Progress.finish()
                    console.log(res);
                }).catch(err=>{
                    console.log(err);
                    this.$Progress.fail()
                })
            },
            csvJSON(csv){
                var vm = this
                var lines = csv.split("\n")
                var result = []
                var headers = lines[0].split(",")
                // console.log(headers);
                vm.parse_header = lines[0].split(",")
                // lines[0].split(",").forEach(function (key) {
                //     vm.sortOrders[key] = 1
                // })

                lines.map(function(line, indexLine){
                    if (indexLine < 1) return // Jump header line

                    var obj = {}
                    var currentline = line.split(",")

                    headers.map(function(header, indexHeader){
                        // console.log(header.trim());
                        obj[header.trim()] = currentline[indexHeader];

                    })

                    result.push(obj)
                })

                // result.pop() // remove the last item because undefined values
                // console.log(result)
                return result // JavaScript object
            },
            loadCSV(e) {
                var vm = this
                if (window.FileReader) {
                    var reader = new FileReader();
                    reader.readAsText(e.target.files[0]);
                    // Handle errors load
                    vm.$Progress.start()
                    reader.onload = function(event) {
                        var csv = event.target.result;
                        vm.parse_csv = vm.csvJSON(csv)
                        vm.$Progress.finish()
                    };
                    reader.onerror = function(evt) {
                        if(evt.target.error.name == "NotReadableError") {
                            alert("Canno't read file !");
                        }
                    };
                } else {
                    alert('FileReader are not supported in this browser.');
                }
            }
        }
    }
</script>
<style>
    .table1 tr th{
        /*background: red;*/
        padding: 0.5em;
        text-align: center;
    }
    .table1 tr td{
        padding-left: 0.2em;
    }
</style>
