import React from "react";

export default function Header() {
    return (
        <header className="bg-blue-600 text-white p-4 shadow-md">
            <div className="container mx-auto flex justify-between items-center">
                <h1 className="text-xl font-bold">Mary Help</h1>
                <nav>
                    <ul className="flex space-x-4">
                        <li>
                            <a href="#" className="hover:text-gray-200">
                                Item
                            </a>
                        </li>
                        <li>
                            <a href="#" className="hover:text-gray-200">
                                Item
                            </a>
                        </li>
                        <li>
                            <a href="#" className="hover:text-gray-200">
                                Item
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
    );
}
