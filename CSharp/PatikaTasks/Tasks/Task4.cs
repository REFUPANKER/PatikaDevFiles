class Task4 : FastCommands, TaskTheme
{
    public void Run()
    {
        Console.Clear();
        WriteLineColorized(ConsoleColor.Yellow, "Removing char at index");
        string? target = null;
        while (target == null)
        {
            WriteLineColorized(ConsoleColor.Yellow, "[!]Target must be valid");
            WriteColorized(ConsoleColor.Green, "Target String :");
            target = ReadLine("");
            if (target != null && target.Length <= 0)
            {
                target = null;
                Console.Clear();
            }
        }
        int? index = null;
        while (index == null)
        {
            WriteLineColorized(ConsoleColor.Green, $"Bounds [{((target.Length > 1) ? "1," + target.Length : 1)}]");
            WriteLineColorized(ConsoleColor.Cyan, $"Target :{target}");
            WriteColorized(ConsoleColor.Green, "Target Index :");
            index = CanConvertStringToInt(ReadLine(""));
            if (index < 0 || index > target.Length)
            {
                index = null;
                Console.Clear();
                WriteLineColorized(ConsoleColor.Yellow, $"[!]Index must be in this bounds [{((target.Length > 1) ? "1," + target.Length : 1)}]");
            }
            else if (index == null)
            {
                Console.Clear();
                WriteLineColorized(ConsoleColor.Yellow, "[!]Index must be number");
            }
        }
        Console.Clear();
        WriteLineColorized(ConsoleColor.Cyan, $"Target :{target}\nIndex  :{index}");
        string result = target.Substring(0, (int)index - 1) + target.Substring((int)index);
        WriteLineColorized(ConsoleColor.Green, $"Result :{result}");
    }
}