class Router extends React.Component {
  render() {
    if (!localStorage.getItem('email'))
      return (
        <React.Fragment>
          <LoginSignupForm />
        </React.Fragment>
      )
  }
}