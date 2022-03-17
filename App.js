class App extends React.Component {
  render() {
    if (!localStorage.getItem('email'))
      return <LoginSignupForm />
    else return <Router />
  }
}