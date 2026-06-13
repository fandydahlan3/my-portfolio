import './footer.css'
import { Col, Container, Image, ListGroup, Row } from 'react-bootstrap';

const footer = () => {
    return (
        <>
            <Container>
                <table>
                    <thead>
                        <Row>
                            <Col>
                                <h4 className='text-start'>Download Now</h4>
                            </Col>
                            <Col>
                                <Image src="src\assets\appstore.png" width={'120'} />
                                <Image src="src\assets\appstore.png" width={'120'} />
                            </Col>
                        </Row>
                    </thead>
                    <tbody>
                        <Row>
                            <Col>
                                <Image src="src\assets\react.svg" />
                                <p>lorem ipsum apalah itu</p>
                            </Col>
                            <Col>
                                <ListGroup className='footer-list'>
                                    <ListGroup.Item className='border-0 footer-list-item'>lorem ipsum apalah itu</ListGroup.Item>
                                    <ListGroup.Item className='border-0  footer-list-item'>lorem ipsum apalah itu</ListGroup.Item>
                                    <ListGroup.Item className='border-0 footer-list-item'>lorem ipsum apalah itu</ListGroup.Item>
                                </ListGroup>
                            </Col>
                            <Col>
                                <ListGroup className='footer-list'>
                                    <ListGroup.Item className='border-0 footer-list-item'>lorem ipsum apalah itu</ListGroup.Item>
                                    <ListGroup.Item className='border-0  footer-list-item'>lorem ipsum apalah itu</ListGroup.Item>
                                    <ListGroup.Item className='border-0 footer-list-item'>lorem ipsum apalah itu</ListGroup.Item>
                                </ListGroup>
                            </Col>
                            <Col>
                                <ListGroup className='footer-list'>
                                    <ListGroup.Item className='border-0 footer-list-item'>lorem ipsum apalah itu</ListGroup.Item>
                                    <ListGroup.Item className='border-0  footer-list-item'>lorem ipsum apalah itu</ListGroup.Item>
                                    <ListGroup.Item className='border-0 footer-list-item'>lorem ipsum apalah itu</ListGroup.Item>
                                </ListGroup>
                            </Col>
                            <Col>
                                <ListGroup className='footer-list'>
                                    <ListGroup.Item className='border-0 footer-list-item'>lorem ipsum apalah itu</ListGroup.Item>
                                    <ListGroup.Item className='border-0  footer-list-item'>lorem ipsum apalah itu</ListGroup.Item>
                                    <ListGroup.Item className='border-0 footer-list-item'>lorem ipsum apalah itu</ListGroup.Item>
                                </ListGroup>
                            </Col>
                        </Row>
                    </tbody>
                </table>
            </Container>
        </>
    )
}

export default footer