<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import { ref, computed } from "vue";
// Layouts
import AdminAuthLayout from "@/Layouts/AdminAuthLayout.vue";
// Components
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import LoadingIndicator from "@/Components/Loadings/LoadingIndicator.vue";
// Components - Forms
import InputLabel from "@/Components/Forms/InputLabel.vue";
import TextInput from "@/Components/Forms/TextInput.vue";
import InputError from "@/Components/Forms/InputError.vue";
// validation
import {
  validateEmail,
  validatePassword,
  validatePasswordConfirmation,
  validateAllFields,
} from "./_components/Validation";
import FormGroup from "@/Components/Forms/FormGroup.vue";

// Props
const props = defineProps({
  email: {
    type: String,
    required: true,
  },
  token: {
    type: String,
    required: true,
  },
});

// Form
const form = useForm({
  token: props.token,
  email: props.email,
  password: "",
  password_confirmation: "",
});

// Loading
const isLoading = ref(false);
const loadingText = ref("");

// ボタンの状態
const submitButtonType = computed(() => {
  return form.email && !form.processing ? "primary" : "secondary";
});

// フォームの送信
const submit = async () => {
  validateAllFields(form);
  isLoading.value = true;
  loadingText.value = "Resetting password...";
  form.post(route("password.store"), {
    onFinish: () => {
      form.reset("password", "password_confirmation");
      isLoading.value = false;
      loadingText.value = "";
    },
  });
};
</script>

<template>
  <AdminAuthLayout>
    <Head title="Reset Password" />

    <LoadingIndicator :isLoading="isLoading" :loadingText="loadingText" />

    <form @submit.prevent="submit">
      <div class="space-y-4">
        <FormGroup>
          <InputLabel for="email" value="Email" />
          <TextInput
            id="email"
            type="email"
            class="mt-1 block w-full"
            v-model="form.email"
            @blur="validateEmail(form)"
            required
            autofocus
            autocomplete="username"
          />
          <InputError class="mt-2" :message="form.errors.email" />
        </FormGroup>
        <FormGroup>
          <InputLabel for="password" value="Password" />
          <TextInput
            id="password"
            type="password"
            class="mt-1 block w-full"
            v-model="form.password"
            @blur="validatePassword(form)"
            required
            autocomplete="new-password"
          />
          <InputError class="mt-2" :message="form.errors.password" />
        </FormGroup>
        <FormGroup>
          <InputLabel for="password_confirmation" value="Confirm Password" />
          <TextInput
            id="password_confirmation"
            type="password"
            class="mt-1 block w-full"
            v-model="form.password_confirmation"
            @blur="validatePasswordConfirmation(form)"
            required
            autocomplete="new-password"
          />
          <InputError
            class="mt-2"
            :message="form.errors.password_confirmation"
          />
        </FormGroup>
        <FormGroup>
          <PrimaryButton
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            :buttonType="submitButtonType"
            type="submit"
          >
            Reset Password
          </PrimaryButton>
        </FormGroup>
      </div>
    </form>
  </AdminAuthLayout>
</template>
