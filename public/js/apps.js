new Vue({
	el: '#app-2',
	data: {
		nominaas:[],
		loading: false,
		error: false,
		potato: '',
		ruta: '',
	},
	methods:{
		buscador: function(){
			this.error ='';
			this.nominaas =[];
			this.loading =true;
			this.http.get('buscanomina/?q='+this.potato).then((response)=>{
				response.body.error ? this.error = response.body.error : this.nominaas = response.body;
				this.loading = false;
				this.potato ='';
			});

		}
	}
});