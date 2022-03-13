
class LoginSignupForm extends React.Component {
  state = {
    isLoginForm: true
  };

  render() {
    const { isLoginForm } = this.state;
    return (
      <React.Fragment>
        <div className="container">
          <div className="card">
            <div className="card-conatiner">
              <div className="inner-box" id="card" style={{ transform: isLoginForm ? "rotateY(0deg)" : "rotateY(-180deg)" }}>
                <Login signup={() => this.setState({ isLoginForm: false })} />
                <Signup login={() => this.setState({ isLoginForm: true })} />
              </div>
            </div>
          </div>
        </div>
      </React.Fragment>
    );
  }
}
