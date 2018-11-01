<!DOCTYPE html>
<html>
<head>
	<title>CRUD PHP - VUE</title>
	<link rel="stylesheet" href="style.css"></style>
	

</head>
<body>
	<div id="root">
		<div class="container">
			<h1 class="fleft">List of users</h1>
			<button class="fright addNew" @click="showingAddModal = true;">Add New</button>
			<div class="clear"></div>
			<hr>
			<p class="errorMessage" v-if="errorMessage">
				{{errorMessage}}
			</p>
			<p class="successMessage" v-if="successMessage">
				{{successMessage}}
			</p>
			<table class="list">
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Email</th>
					<th colspan="2">Operacoes</th>
				</tr>
				<tr v-for="user in users">
					<td>{{user.id}}</td>
					<td>{{user.name}}</td>
					<td>{{user.email}}</td>
					<td><button @click="showingEditModal = true; selectUser(user)">Edit</button></td>
					<td><button @click="showingDeleteModal = true; selectUser(user)">Excl</button></td>
				</tr>
			</table>
		</div>

		<div class="modal" id="addModal" v-if="showingAddModal">
			<div class="modalContainer">
				<div class="modalHeading">
					<p class="fleft">Add New User</p>
					<button class="fright close" @click="showingAddModal = false;">x</button>
					<div class="clear"></div>
				</div>

				<div class="modalContent">
					<table class="form">
						<tr>
							<th>Username</th>
							<th> : </th>
							<td><input type="text" name="name" v-model="newUser.name"></td>
						</tr>
						<tr>
							<th>Email</th>
							<th> : </th>
							<td><input type="text" name="email" v-model="newUser.email"></td>
						</tr>
						<tr>
							<th></th>
							<th></th>
							<td><button @click="showingAddModal = false; saveUser();">Save</button></td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<div class="modal" id="editModal" v-if="showingEditModal">
			<div class="modalContainer">
				<div class="modalHeading">
					<p class="fleft">Edit New User</p>
					<button class="fright close" @click="showingEditModal = false;">x</button>
					<div class="clear"></div>
				</div>

				<div class="modalContent">
					<table class="form">
						<tr>
							<th>Username</th>
							<th> : </th>
							<td><input type="text" name="name" v-model="clickedUser.name"></td>
						</tr>
						<tr>
							<th>Email</th>
							<th> : </th>
							<td><input type="text" name="email" v-model="clickedUser.email"></td>
						</tr>
						<tr>
							<th></th>
							<th></th>
							<td><button @click="showingEditModal = false; updateUser()">Update</button></td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<div class="modal" id="deleteModal" v-if="showingDeleteModal">
			<div class="modalContainer">
				<div class="modalHeading">
					<p class="fleft">Delete New User</p>
					<button class="fright close" @click="showingDeleteModal = false;">x</button>
					<div class="clear"></div>
				</div>

				<div class="modalContent">
					<p>Delete this user {{clickedUser.name}} ?</p>
					<br><br><br><br>
					<button @click="showingDeleteModal = false; deleteUser()">Yes</button>
					<button @click="showingDeleteModal = false;">No</button>
				</div>
			</div>
		</div>

	</div>

	<script src="vue.js"></script>
	<script src="axios.min.js"></script>
	<script src="functions.js"></script>
</body>
</html>