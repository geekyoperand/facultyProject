const Toast = (props) => Toastify({
  text: props.text,
  duration: 2000,
  close: true,
  style: {
    background: props.error ? 'linear-gradient(to right, white, 1% , #ff2626)' : "linear-gradient(to right, #00b09b, #96c93d)",
  },
}).showToast();