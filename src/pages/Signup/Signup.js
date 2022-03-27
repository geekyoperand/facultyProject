class Signup extends React.Component {
  formRef = React.createRef();
  render() {
    const { Button, Input, Form } = antd;
    const onFinish = async (formData, method) => {
      if (formData['confirm-password'] !== formData.password)
        return Toast({ text: "Password doesn't match!", error: true })
      const url = "./api/signinService.php";
      const response = await axios({
        method: 'post',
        url,
        data: formData,
        config: { headers: { 'Content-Type': 'application/json' } }
      })
      let result = response && response.data
      if (result && result.status === 200) {
        Toast({ text: "Signup successful" })
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

    const restFeilds = () => this.formRef.current.setFieldsValue({ name: '', email: '', ['confirm-password']: '', password: '' })

    return (
      <div className="card-back">
        <div className="card-header">
          <h2>Sign Up</h2>
        </div>
        <div className="card-content">
          <Form
            ref={this.formRef}
            onFinish={onFinish}
            className="form-container"
            autoComplete="off"
            onFinishFailed={onFinishFailed}
          >
            <Form.Item
              name="name"
              className="login-form-input"
              rules={[
                {
                  type: "string",
                  pattern: "^[a-zA-Z-' ]*$",
                  message: "The input is not valid name",
                },
                {
                  required: true,
                  message: "Please input last name",
                },
              ]}
            >
              <Input
                className="input-box"
                placeholder="Enter your name"
              />
            </Form.Item>
            <Form.Item
              name="email"
              className="login-form-input"
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
                placeholder="Enter your email"
              />
            </Form.Item>
            <Form.Item
              name="password"
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
                className="input-box"
                placeholder="Enter password"
              />
            </Form.Item>
            <Form.Item
              name="confirm-password"
              className="login-form-input"
              rules={[
                {
                  required: true,
                  message: 'Please confirm password!',
                },
              ]}
            >
              <Input
                className="input-box"
                placeholder="Confirm password"
              />
            </Form.Item>

            <Form.Item
              className="login-form-input"
            >
              <Button htmlType="submit" className="submit-btn Button">Submit</Button>
            </Form.Item>
          </Form>
        </div>
        <div className="card-footer">
          <Button className='Button' onClick={() => { this.props.login(); restFeilds() }}>
            Already have an account
          </Button>
          <a href="">Forgot Password</a>
        </div>
      </div>
    )
  }
}
