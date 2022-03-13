const layout = {
  labelCol: {
    span: 6,
  },
  wrapperCol: {
    span: 18,
  },
};
const tailLayout = {
  wrapperCol: {
    offset: 8,
    span: 16,
  },
};
class Classes extends React.Component {
  formRef = React.createRef();
  state = {
    showModal: false
  }
  onFinish = () => this.setState({ showModal: false })
  render() {
    const { Card, Button, Modal, Form, Table, Input } = antd
    const { showModal } = this.state
    const columns = [
      {
        title: "Sr.No.",
        width: '10%',
        dataIndex: "index",
        key: "index",
        render: (value) => value + 1,
      }, {
        title: "Class Name",
        width: '30%',
        dataIndex: "classname",
        editable: true,
        key: "classname",
        render: (text) => (
          <span style={{ color: '#269fe3' }}>
            {text}
          </span>
        ),
      }, {
        title: "Subject",
        width: '40%',
        dataIndex: "subject",
        key: "subject",
        editable: true,
      }, {
        title: "Action",
        width: '15%',
        dataIndex: "action",
        key: "action",
        render: (text, record) => (
          <Button type="primary">
            {/* TODO: Show details in modal or in new page. */}
            View
          </Button>
        ),
      },
    ];

    const classList = [{
      index: 0,
      classname: 'MCA II',
      subject: 'Computer Application',
    }, {
      index: 1,
      classname: 'MCA I',
      subject: 'Java',
    }, {
      index: 2,
      classname: 'BCA VI',
      subject: 'C++',
    }, {
      index: 3,
      classname: 'BCA III',
      subject: 'PHP',
    },]

    return (
      <React.Fragment>
        <Card title="Classes" className="gx-card">
          <div style={{ textAlign: "right", margin: '10px 0' }}>
            <Button type="primary" onClick={() => this.setState({ showModal: true })}>
              Create Class
            </Button>
          </div>
          <Table
            size={'small'}
            dataSource={classList}
            columns={columns}
            scroll={{ x: true }}
            rowClassName="editable-row"
            pagination={{ pageSize: 10 }}
            className="gx-table-responsive"
          />
        </Card>
        <Modal
          title={"Create Class"}
          visible={showModal}
          footer={null}
          onCancel={() => this.setState({ showModal: false })}
        >
          <Form
            ref={this.formRef}
            {...layout}
            name="createclass"
            onFinish={this.onFinish}
            scrollToFirstError
          >
            <Form.Item
              name="classname"
              label="Class Name"
              rules={[
                {
                  type: "string",
                  message: "The input is not valid Class Name",
                },
                {
                  required: true,
                  message: "Please enter class name",
                },
              ]}
            >
              <Input placeholder="Enter class name" />
            </Form.Item>
            <Form.Item
              name="subject"
              label="Subject"
              rules={[
                {
                  type: "string",
                  message: "The input is not valid Subject",
                },
                {
                  required: true,
                  message: "Please enter subject",
                },
              ]}
            >
              <Input placeholder="Enter subject" />
            </Form.Item>
            <Form.Item {...tailLayout}>
              <div style={{ textAlign: "right" }}>
                <Button type="primary" htmlType="submit">
                  Create
                </Button>
              </div>
            </Form.Item>
          </Form>
        </Modal>
      </React.Fragment>
    )
  }
}