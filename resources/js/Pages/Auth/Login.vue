<template>
  <Head title="Log in" />

  <div
    class="
      absolute
      top-0
      left-0
      z-20
      min-h-screen
      w-1/2
      flex flex-col
      sm:justify-center
      items-center
      bg-main
      animate
    "
    :class="isLoginAnimated ? ' runToLeft' : ' runToRight'"
  >
    <div
      class="
        min-h-screen
        flex flex-col
        sm:justify-center
        items-center
        pt-6
        sm:pt-0
        absolute
        w-4/5
        opacity-0
      "
      :class="{ activeLogin: isLoginAnimated }"
    >
      <jet-authentication-card>
        <template #logo>
          <jet-authentication-card-logo />
        </template>

        <div v-if="status" class="mb-4 font-medium text-base text-success">
          {{ status }}
        </div>

        <form @submit.prevent="submit">
          <div class="text-black mb-16">
            <div class="text-4xl mb-4">Welcome Back !</div>
            <div class="text-sm">Already have an account ?</div>
          </div>

          <jet-validation-errors class="mb-4" />

          <div>
            <jet-label for="email" value="Email" />
            <jet-input
              id="email"
              type="email"
              class="mt-1 block w-full"
              v-model="formLogin.email"
              required
              autofocus
            />
          </div>

          <div class="mt-12">
            <jet-label for="password" value="Password" />
            <jet-input
              id="password"
              type="password"
              class="mt-1 block w-full"
              v-model="formLogin.password"
              required
              autocomplete="current-password"
            />
          </div>

          <div class="block mt-4">
            <label class="flex items-center">
              <jet-checkbox
                name="remember"
                v-model:checked="formLogin.remember"
              />
              <span class="ml-2 text-base text-black">Remember me</span>
            </label>
          </div>

          <div class="flex items-center justify-center mt-12">
            <jet-button
              class="bg-gray-400 text-3xl font-normal rounded-3xl"
              :class="{ 'opacity-25': formLogin.processing }"
              :disabled="formLogin.processing"
            >
              Log in
            </jet-button>
          </div>

          <div class="flex items-center justify-center mt-12">
            <Link
              :href="route('register')"
              class="text-base text-black hover:text-black"
            >
              Register
            </Link>
            <span class="mx-3 text-black">|</span>
            <Link
              :href="route('password.request')"
              class="text-base text-black hover:text-black"
            >
              Forgot your password?
            </Link>
          </div>
        </form>
      </jet-authentication-card>
    </div>

    <div
      class="
        min-h-screen
        flex flex-col
        sm:justify-center
        items-center
        pt-6
        sm:pt-0
        bg-main
        absolute
        w-4/5
        opacity-0
      "
      :class="{ activeSignin: isSigninAnimated }"
    >
      <jet-authentication-card>
        <template #logo>
          <jet-authentication-card-logo />
        </template>

        <form @submit.prevent="submitRegister">
          <div class="text-black mb-16">
            <div class="text-4xl mb-4">Login</div>
            <div class="text-sm">
              Fill your personal informations <br />
              and start the journey with us!
            </div>
          </div>

          <jet-validation-errors class="mb-4" />

          <div class="flex justify-center">
            <div class="w-1/2">
              <jet-label for="name" value="Name" />
              <jet-input
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="formRegister.name"
                required
                autofocus
                autocomplete="name"
              />
            </div>

            <div class="ml-4 w-1/2">
              <jet-label for="email" value="Email" />
              <jet-input
                id="email"
                type="email"
                class="mt-1 block w-full"
                v-model="formRegister.email"
                required
              />
            </div>
          </div>

          <div class="mt-12">
            <jet-label for="password" value="Password" />
            <jet-input
              id="password"
              type="password"
              class="mt-1 block w-full"
              v-model="formRegister.password"
              required
              autocomplete="new-password"
            />
          </div>

          <div class="mt-12">
            <jet-label for="password_confirmation" value="Confirm Password" />
            <jet-input
              id="password_confirmation"
              type="password"
              class="mt-1 block w-full"
              v-model="formRegister.password_confirmation"
              required
              autocomplete="new-password"
            />
          </div>

          <div
            class="mt-12"
            v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
          >
            <jet-label for="terms">
              <div class="flex items-center">
                <jet-checkbox
                  name="terms"
                  id="terms"
                  v-model:checked="formRegister.terms"
                />

                <div class="ml-2">
                  I agree to the
                  <a
                    target="_blank"
                    :href="route('terms.show')"
                    class="
                      underline
                      text-base text-gray-600
                      hover:text-gray-900
                    "
                    >Terms of Service</a
                  >
                  and
                  <a
                    target="_blank"
                    :href="route('policy.show')"
                    class="
                      underline
                      text-base text-gray-600
                      hover:text-gray-900
                    "
                    >Privacy Policy</a
                  >
                </div>
              </div>
            </jet-label>
          </div>

          <div class="flex items-center justify-center mt-12">
            <jet-button
              class="bg-gray-400 text-3xl font-normal rounded-3xl"
              :class="{ 'opacity-25': formRegister.processing }"
              :disabled="formRegister.processing"
            >
              Register
            </jet-button>
          </div>

          <div class="flex items-center justify-center mt-4">
            <Link
              :href="route('login')"
              class="text-base text-black hover:text-black"
            >
              Login
            </Link>
          </div>
        </form>
      </jet-authentication-card>
    </div>
  </div>

  <div
    class="
      absolute
      top-0
      right-0
      z-10
      min-h-screen
      w-1/2
      flex flex-col
      justify-center
      items-center
    "
    :class="{ active: isAnimated }"
  >
    <div class="flex flex flex-col justify-center items-center">
      <div class="mb-2 text-4xl">Create Account</div>
      <jet-button
        class="
          bg-main
          hover:bg-secondary
          text-3xl
          font-normal
          rounded-3xl
          opacity-75
        "
        @click="animateLogin"
      >
        SIGN UP
      </jet-button>
    </div>
  </div>

  <div
    class="
      absolute
      top-0
      left-0
      z-10
      min-h-screen
      w-1/2
      flex flex-col
      justify-center
      items-center
    "
    :class="{ active: isAnimated }"
  >
    <div class="flex flex flex-col justify-center items-center">
      <div class="mb-2 text-4xl">Have an Account ?</div>
      <jet-button
        class="
          bg-main
          hover:bg-secondary
          text-3xl
          font-normal
          rounded-3xl
          opacity-75
        "
        @click="animateSignin"
      >
        LOG IN
      </jet-button>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    Head,
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
    Link,
  },

  props: {
    canResetPassword: Boolean,
    status: String,
  },

  data() {
    return {
      formLogin: this.$inertia.form({
        email: "",
        password: "",
        remember: false,
      }),
      formRegister: this.$inertia.form({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        terms: false,
      }),
      isLoginAnimated: true,
      isSigninAnimated: false,
    };
  },

  methods: {
    animateLogin() {
      this.isLoginAnimated = !this.isLoginAnimated;
      this.isSigninAnimated = !this.isSigninAnimated;
    },

    animateSignin() {
      this.isLoginAnimated = !this.isLoginAnimated;
      this.isSigninAnimated = !this.isSigninAnimated;
    },

    submit() {
      this.formLogin
        .transform((data) => ({
          ...data,
          remember: this.formLogin.remember ? "on" : "",
        }))
        .post(this.route("login"), {
          onFinish: () => this.formLogin.reset("password"),
        });
    },
    submitRegister() {
      this.formRegister.post(this.route("register"), {
        onFinish: () => this.formRegister.reset("password", "password_confirmation"),
      });
    },
  },
});
</script>

<style>
.animate {
  -webkit-animation-duration: 0.3s !important;
  -webkit-animation: linear;
  animation-fill-mode: forwards;
}
.activeLogin,
.activeSignin {
  opacity: 1 !important;
  display: flex;
  transition: opacity 0.2s ease-in-out;
  z-index: 30;
}

.runToLeft {
  -webkit-animation-name: runToLeft;
}
.runToRight {
  -webkit-animation-name: runToRight;
}

@-webkit-keyframes runToRight {
  0% {
    transform: translateX(0%);
  }
  50% {
    transform: translateX(50%);
  }
  100% {
    transform: translateX(100%);
  }
}

@-webkit-keyframes runToLeft {
  0% {
    transform: translateX(100%);
  }
  50% {
    transform: translateX(50%);
  }
  100% {
    transform: translateX(0%);
  }
}
</style>
