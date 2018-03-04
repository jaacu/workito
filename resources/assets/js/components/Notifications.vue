<template>
	<div class="dropdown-menu">
		<a :href="notification.data.ruta" class="dropdown-item"  v-for="notification in filteredItems">
			{{ notification.data.mensaje }}
		</a>
	</div>
</template>

<script>
export default{
	props: ['user'],
	data() {
		return {
			notifications: []
		}
	},
	mounted() {
		axios.get('/proyecto/api/notifications')
		.then(response => {
			this.notifications = response.data;

			// Echo.private('App.User.${this.user}')
			// .notification(notification => {
			// 	this.notifications.unshift(notification);
			// });
		});
	},
	computed: {
		filteredItems: function () {
			return this.notifications.slice(0, 7)
		}
	}
}
</script>