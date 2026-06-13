import { Card, Image, ListGroup } from "react-bootstrap"
import './styles/features.css'
import * as Icon from 'react-bootstrap-icons';

const features = () => {
    return (
        <>
            <div className="container feature my-4">
                <h5 className="mt-2 text-center">Explore All Features</h5>
                <table>
                    <tbody>
                        <tr className="mt-3">
                            <td>
                                {/* <div className="feature-ellipse"></div> */}
                                <Image src="src\assets\showcase.png" height={450} />
                            </td>
                            <td>
                                <Card style={{ width: '24rem' }} className="border-0 feature-card m-3">
                                    <Card.Body>
                                        <Card.Title>Card Title</Card.Title>
                                        <Card.Text>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                        </Card.Text>
                                    </Card.Body>
                                </Card>
                            </td>
                        </tr>
                        <tr className="mt-3">
                            <td>
                                <Card style={{ width: '20rem' }} className="border-0 feature-card m-3">
                                    <Card.Body>
                                        <Card.Title>Find the <span>best place</span> for your <span>activity</span></Card.Title>
                                        <Card.Text>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                        </Card.Text>
                                    </Card.Body>
                                </Card>
                            </td>
                            <td>
                                <div className="feature-ellipse align-item-center"></div>
                            </td>
                        </tr>
                        <tr className="mt-3">
                            <td>
                                <Image src="src\assets\showcase-2.png" height={500} className="me-0" />
                            </td>
                            <td>
                                <Card style={{ width: '18rem' }} className="border-0 feature-card m-3">
                                    <Card.Body>
                                        <Card.Title>Create and find fun hobbies <span>easily!</span></Card.Title>
                                        <Card.Text>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                        </Card.Text>
                                    </Card.Body>
                                </Card>
                            </td>
                        </tr>
                        <tr className="mt-3">
                            <td>
                                <Card style={{ width: '20rem' }} className="border-0 feature-card m-3">
                                    <Card.Body>
                                        <Card.Title>Exclusive Membership of <span>TinggalKlik App</span></Card.Title>
                                        <Card.Text>
                                            <ListGroup >
                                                <ListGroup.Item className="border-0"><Icon.CheckLg/> Ullamcorper morbi tincidunt</ListGroup.Item>
                                                <ListGroup.Item className="border-0"><Icon.CheckLg/> Ullamcorper morbi tincidunt</ListGroup.Item>
                                                <ListGroup.Item className="border-0"><Icon.XLg/> Ullamcorper morbi tincidunt</ListGroup.Item>
                                            </ListGroup>
                                        </Card.Text>
                                    </Card.Body>
                                </Card>
                            </td>
                            <td>
                                {/* <div className="feature-ellipse align-item-center"></div> */}
                                <Image src="src\assets\showcase-3.png" height={500} className="me-0" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </>
    )
}

export default features