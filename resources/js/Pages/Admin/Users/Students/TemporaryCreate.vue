<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
// Layouts
import AdminDashboardLayout from '@/Layouts/AdminDashboardLayout.vue';
// Components
import Breadcrumb from '@/Components/Breadcrumb.vue';
import Button from '@/Components/Button.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
// Components - Form
import InputLabel from '@/Components/Forms/InputLabel.vue';
import TextInput from '@/Components/Forms/TextInput.vue';
import TextArea from '@/Components/Forms/TextArea.vue';
import InputError from '@/Components/Forms/InputError.vue';
import ImageUpload from '@/Components/Forms/ImageUpload.vue';
import Separator from '@/Components/Separator.vue';

const form = useForm({
    name: '',
  type: '',
  code: '',
  established_date: '',
  color_code: '',
  description: '',
  email: '',
  zipcode: '',
  address1: '',
  address2: '',
  address3: '',
  address4: '',
  phone_number: '',
  fax_number: '',
  website: '',
  facebook: '',
  twitter: '',
  instagram: '',
  youtube: '',
  line: '',
  store_photo_path: '',
  store_logo_path: '',
  status: '',
})

</script>

<template>



</template>