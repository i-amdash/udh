// tailwind.config.js
module.exports = {
    theme: {
      extend: {
        keyframes: {
          rotate: {
            '0%': { transform: 'rotate(0deg)' },
            '100%': { transform: 'rotate(180deg)' },
          },
        },
        animation: {
          rotate: 'rotate 0.3s ease-in-out',
        },
      },
    },
    plugins: [],
  }
  