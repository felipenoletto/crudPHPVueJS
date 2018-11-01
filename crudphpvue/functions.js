var app = new Vue({

	el: "#root",
	data: {
		showingAddModal: false,
		showingEditModal: false,
		showingDeleteModal: false,
		successMessage: "",
		errorMessage: "",
		users: [],
		newUser: {name: "",email: ""},
		clickedUser: {}
	},

	mounted: function() {
		this.getAllUsers();
	},

	methods: {
		getAllUsers: function() {
			axios.get(
				"http://localhost/crudphpvue/model.php?p=read"
				).then(function(response) {
					if(response.data.error) {
						app.errorMessage = response.data.message;
					} else {
						app.users = response.data.users;
					}
				});
		},

		saveUser: function() {

			var formData = app.toFormData(app.newUser);

			axios.post(
				"http://localhost/crudphpvue/model.php?p=insert", 
				formData
				).then(function(response) {
					app.newUser = {name: "", email: ""};

					if(response.data.error) {
						app.errorMessage = response.data.message;
					} else {
						app.successMessage = response.data.message;
						app.getAllUsers();
					}
				});
		},

		updateUser: function() {

			var formData = app.toFormData(app.clickedUser);

			axios.post(
				"http://localhost/crudphpvue/model.php?p=update", 
				formData
				).then(function(response) {
					app.clickedUser = {};

					if(response.data.error) {
						app.errorMessage = response.data.message;
					} else {
						app.successMessage = response.data.message;
						app.getAllUsers();
					}
				});
		},

		deleteUser: function() {

			var formData = app.toFormData(app.clickedUser);

			axios.post(
				"http://localhost/crudphpvue/model.php?p=delete", 
				formData
				).then(function(response) {
					app.clickedUser = {};

					if(response.data.error) {
						app.errorMessage = response.data.message;
					} else {
						app.successMessage = response.data.message;
						app.getAllUsers();
					}
				});
		},

		selectUser(user) {
			app.clickedUser = user;
		},

		toFormData: function(obj) {
			var form_data = new FormData();
			for(var key in obj) {
				form_data.append(key, obj[key]);
			}
			return form_data;
		},

		clearMessage: function() {
			app.errorMessage = "";
			app.successMessage = "";
		}
	}

});