public class Task1 : FastCommands, TaskTheme
{
    public void Run()
    {
        string entry = ReadLine(), r = "";
        for (int i = 0; i < entry.Length; i++)
        {
            r = entry[i] + r;
        }
        cwl(r);
    }

}