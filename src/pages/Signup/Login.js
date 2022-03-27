class Login extends React.Component {
  formRef = React.createRef()
  render() {
    const { Button, Input, Form } = antd

    const onFinish = async (formData, method) => {
      const url = "./api/loginService.php"
      const response = await axios({
        method: 'post',
        url,
        data: formData,
        config: { headers: { 'Content-Type': 'application/json' } }
      })
      let result = response && response.data
      if (result && result.status === 200) {
        Toast({ text: "Login successful" })
        localStorage.clear();
        localStorage.setItem('token', result.token)
        location.replace("http://localhost/facultyProject/");
        restFeilds()
      }
      else
        Toast({ text: result.error, error: true })
      }
    const onFinishFailed = ({ errorFields }) => {
      errorFields.forEach(err => Toast({ text: err.errors, error: true }))
    }

    const restFeilds = () => this.formRef.current.setFieldsValue({ useremail: '', userpassword: '' })

    return (
      <div className="card-front">
        <div className="card-header">
          <h2>Log In</h2>
          <img src="" />
        </div>
        <div className="card-content">
          <Form
            ref={this.formRef}
            onFinish={onFinish}
            onFinishFailed={onFinishFailed}
            className="form-container"
            scrollToFirstError
          >
            <Form.Item
              className="login-form-input"
              name="useremail"
              rules={[
                {
                  type: "email",
                  pattern: "^[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}$",
                  message: "The input is not valid email",
                },
                {
                  required: true,
                  message: "Please input email",
                },
              ]}
            >
              <Input
                className="input-box"
                placeholder="Your email"
              />
            </Form.Item>
            <Form.Item
              name="userpassword"
              className="login-form-input"
              rules={[
                {
                  type: "string",
                  pattern: "^(?=.*[0-9])[a-zA-Z0-9!@#$%^&*]{6,16}$",
                  message: "Password must be alphanumeric",
                },
                {
                  required: true,
                  message: 'Please enter password!',
                },
              ]}
            >
              <Input
                type="password"
                className="input-box"
                placeholder="Your password"
              />
            </Form.Item>
            <div className="remember-me-btn-layout">
              <Input type="checkbox" /><span>Remember Me</span>
            </div>
            <Form.Item
              className="login-form-input"
            >
              <Button className="submit-btn Button" htmlType="submit">Submit</Button>
            </Form.Item>
          </Form>
        </div>
        <div className="card-footer">
          <Button className="Button" onClick={() => { this.props.signup(); restFeilds() }}>
            Create account
          </Button>
          <a href="">Forgot Password</a>
        </div>
      </div>
    )
  }
}
