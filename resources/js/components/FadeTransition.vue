<template>
	<transition enter-active-class="animated fadeIn"  leave-active-class="animated fadeOut"  appear>
		<slot></slot>
	</transition>
</template>
<script>
export default {};
</script>
