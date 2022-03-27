class Layout extends React.Component {
  state = {
    collapsed: false,
    loading: true,
  }

  render() {
    const { collapsed } = this.state;
    const { userData } = this.props;
    const { Layout, Menu, Input, Popconfirm, Button } = antd
    const { Search } = Input;
    const { Header, Content, Sider } = Layout;
    // const { SubMenu } = Menu;

    const onCollapse = () => {
      this.setState({ collapsed: !collapsed })
    }

    const userDetails = {
      name: "Mrs John Smith ",
      gender: 'female'
    }

    return (
      <Layout style={{ minHeight: '100vh' }}>
        <Header className="site-layout-background" style={{ padding: 0, background: 'white', boxShadow: '0px 0px 10px 0px rgb(0 0 0 / 30%)', zIndex: 10 }} >
          <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', height: '100%', weight: "100%", padding: '0 15px' }} >
            <div style={{ display: 'flex' }}>
              <div onClick={onCollapse} style={{ width: 50, fontSize: 20, display: 'flex', alignItems: 'center', justifyContent: 'center' }}>
                {this.state.collapsed ? (
                  <i class="material-icons">&#xe23d;</i>
                ) : (
                  <i class="material-icons">&#xe23e;</i>
                )}
              </div>
              <div>
                <img src="src/assets/images/lkctcLogo.jpg" style={{ width: 40, height: 40, margin: '0 10px' }} />
                {!collapsed && <span style={{ fontSize: 14, fontWeight: 600 }}>Lyallpur Khalsa College Technical Campus (LKCTC)</span>}
              </div>
            </div>
            <div style={{ display: 'flex' }}>
              <Search placeholder="Search in app..." style={{ width: 200 }} />
              <Popconfirm placement="topLeft" title={'Are your sure you want to logout'} onConfirm={() => { localStorage.removeItem('token'); location.replace("http://localhost/facultyProject/"); }} okText="Yes" cancelText="No">
                <Button style={{ marginLeft: 20, textAlign: 'center' }} type="primary">Logout</Button>
              </Popconfirm>
            </div>
            {/* <div style={{ background: 'white', border: '2px solid #00000015', minWidth: 250, width: '25%', height: 30, padding: 5, borderRadius: 50, display: 'flex', alignItems: 'center' }}>
              <i style={{ color: 'grey' }} class="material-icons">&#xe880;</i>
              <Input size="medium" />
            </div> */}
          </div>
        </Header>
        <Layout className="site-layout">
          <Sider trigger={null} collapsed={collapsed} onCollapse={onCollapse} style={{ boxShadow: '-7px 0px 20px 0px rgb(0 0 0 / 33%)', zIndex: 9 }}>
            <div style={{ width: '100%', height: 60, display: 'flex', alignItems: 'center', justifyContent: 'center', fontSize: 13 }}>
              {/* <img src={userDetails.gender === "male" ? '../../assets/icons/femaleProfile.png' : '../../assets/icons/femaleProfile.png'} alt="profile_img" /> */}
              <i class="material-icons">&#xe853;</i>
              {!collapsed && (<span>{userData.name}</span>)}
            </div>
            <Menu theme="dark" defaultSelectedKeys={['1']} mode="inline">
              <Menu.Item key="1" style={{ color: 'black' }}>
                <i class="material-icons">&#xe7ee;</i>
                {!collapsed && 'Classes'}
              </Menu.Item>
              <Menu.Item key="2" style={{ color: 'black' }}>
                <i class="material-icons">&#xe7ef;</i>
                {!collapsed && 'Students'}
              </Menu.Item>
              {/* <SubMenu key="sub2" title="Team">
              <Menu.Item key="6">Team 1</Menu.Item>
              <Menu.Item key="8">Team 2</Menu.Item>
            </SubMenu> */}
            </Menu>
          </Sider>
          <Layout style={{ padding: 20, minHeight: 280 }}>
            {/* <Content
              className="site-layout-background"
              style={{
                padding: 24,
                margin: 0,

                background: 'red',
                minHeight: 280,
              }}
            > */}
            <Classes />
            {/* </Content> */}
          </Layout>
        </Layout>
      </Layout>
    );
  }
}
