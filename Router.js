class Router extends React.Component {
  state = {
    isValidUser: false,
    loading: true,
    userData: {}
  }
  async componentDidMount() {
    if (localStorage.getItem('token')) {
      const url = "./api/getUserDetailsService.php"
      const response = await axios.get(url,
        { headers: { 'Content-Type': 'application/json', 'tokenId': localStorage.getItem('token') } }
      )
      let result = response && response.data;
      if (result.success) this.setState({ isValidUser: true, loading: false, userData: result.data })
      else {
        this.setState({ isValidUser: false, loading: false })
        localStorage.clear()
        location.replace("http://localhost/facultyProject/");
      }
    }
    else this.setState({ isValidUser: false, loading: false })
  }

  render() {
    const { loading, isValidUser, userData } = this.state;
    const { Spin } = antd
    return (
      loading
        ? <div style={{ width: '100%', display: 'flex', alignItems: 'center', justifyContent: 'center' }}><Spin /></div>
        : isValidUser
          ? <Layout userData={userData} />
          : <LoginSignupForm />
    )
  }
}